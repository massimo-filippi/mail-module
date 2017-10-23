<?php

namespace MassimoFilippi\MailModule\Adapter\SparkPost;

use GuzzleHttp\Client as GuzzleHttpClient;
use Http\Adapter\Guzzle6\Client as GuzzleHttpAdapter;
use MassimoFilippi\MailModule\Adapter\AdapterInterface;
use MassimoFilippi\MailModule\Model\Message\MessageInterface;
use SparkPost\SparkPost;
use SparkPost\SparkPostPromise;

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
     * @return SparkPostPromise
     */
    public function sendMail(MessageInterface $message)
    {

        $httpClient = new GuzzleHttpAdapter(new GuzzleHttpClient());
        $sparky = new SparkPost($httpClient, [
            'key' => $this->getApiKey(),
        ]);

        $sparky->setOptions(['async' => false]);
        $results = $sparky->transmissions->post([
            'content' => [
                'template_id' => 'recovery-email',
            ],
            'substitution_data' => [
                'email' => $email,
                'key' => $key,
            ],
            'recipients' => [
                [
                    'address' => [
                        'email' => $email,
                    ],
                ],
            ],
        ]);

        return $results;
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
