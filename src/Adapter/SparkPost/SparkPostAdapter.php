<?php

namespace MassimoFilippi\MailModule\Adapter\SparkPost;

use GuzzleHttp\Client as GuzzleHttpClient;
use Http\Adapter\Guzzle6\Client as GuzzleHttpAdapter;
use MassimoFilippi\MailModule\Adapter\AdapterInterface;
use MassimoFilippi\MailModule\Exception\RuntimeException;
use MassimoFilippi\MailModule\Model\Message\MessageInterface;
use MassimoFilippi\MailModule\Model\Message\SparkPostMessage;
use SparkPost\SparkPost;

/**
 * Class SparkPostAdapter
 * @package MassimoFilippi\MailModule\Adapter\SparkPost
 */
class SparkPostAdapter implements AdapterInterface
{
    /**
     * @var string
     */
    private $apiKey = '';

    //-------------------------------------------------------------------------

    /**
     * SparkPostAdapter constructor.
     * @param array $options
     */
    public function __construct(array $options)
    {
        if (array_key_exists('api_key', $options)) {
            $this->setApiKey($options['api_key']);
        }
    }

    //-------------------------------------------------------------------------

    /**
     * @param MessageInterface $message
     */
    public function sendMail(MessageInterface $message)
    {
        $payload = [];

        $payload['content'] = [
            'from' => [
                'name' => $message->getSender()->getName(),
                'email' => $message->getSender()->getEmail(),
            ],
            'subject' => $message->getSubject(),
            'html' => $message->getMessage(),
            'text' => strip_tags($message->getMessage()),
        ];

        $payload['recipients'] = [];
        foreach ($message->getRecipients() as $recipient) {
            $payload['recipients'][] = [
                'address' => [
                    'name' => $recipient->getName(),
                    'email' => $recipient->getEmail(),
                ],
            ];
        }
        unset($recipient);

        if ($message->hasRecipientsCc()) {
            $payload['cc'] = [];
            foreach ($message->getRecipientsCc() as $recipient) {
                $payload['cc'][] = [
                    'address' => [
                        'name' => $recipient->getName(),
                        'email' => $recipient->getEmail(),
                    ],
                ];
            }
            unset($recipient);
        }

        if ($message->hasRecipientsBcc()) {
            $payload['bcc'] = [];
            foreach ($message->getRecipientsBcc() as $recipient) {
                $payload['bcc'][] = [
                    'address' => [
                        'name' => $recipient->getName(),
                        'email' => $recipient->getEmail(),
                    ],
                ];
            }
            unset($recipient);
        }

        if ($message instanceof SparkPostMessage) {
            // todo: implement
        }

        try {
            $sparky = $this->createSparky();

            $promise = $sparky->transmissions->post($payload);

            $response = $promise->wait();

            // todo: needs work!
            if (200 !== $response->getStatusCode()) {
                throw new RuntimeException($response->getReasonPhrase());
            }
        } catch (\Exception $exception) {
            throw new RuntimeException('Exception raised during sending mail.', $exception->getCode(), $exception);
        }
    }

    //-------------------------------------------------------------------------

    /**
     * @return SparkPost
     */
    private function createSparky()
    {
        $httpClient = new GuzzleHttpAdapter(new GuzzleHttpClient());

        $sparky = new SparkPost($httpClient, [
            'key' => $this->getApiKey(),
        ]);

        //$sparky->setOptions(['async' => false]);
        //$sparky->setOptions(['debug' => true]);

        return $sparky;
    }

    //-------------------------------------------------------------------------

    /**
     * @return string
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }

    /**
     * @param string $apiKey
     */
    public function setApiKey($apiKey)
    {
        $this->apiKey = (string)$apiKey;
    }
}
