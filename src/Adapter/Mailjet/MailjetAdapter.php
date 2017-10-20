<?php

namespace MassimoFilippi\MailModule\Adapter\Mailjet;

use MassimoFilippi\MailModule\Adapter\AdapterInterface;
use MassimoFilippi\MailModule\Exception\RuntimeException;
use MassimoFilippi\MailModule\Model\Message\MailjetMessage;
use MassimoFilippi\MailModule\Model\Message\MessageInterface;
use Mailjet;

/**
 * Class MailjetAdapter
 * @package MassimoFilippi\MailModule\Adapter\Mailjet
 */
class MailjetAdapter implements AdapterInterface
{

    /**
     * @var string
     */
    private $apiKey = '';

    /**
     * @var string
     */
    private $apiSecret = '';

    /**
     * @var bool
     */
    private $sandboxMode = false;

    //-------------------------------------------------------------------------

    /**
     * MailjetAdapter constructor.
     * @param $apiKey
     * @param $apiSecret
     * @param bool $sandboxMode
     */
    public function __construct($apiKey, $apiSecret, $sandboxMode = false)
    {
        $this->apiKey = (string)$apiKey;
        $this->apiSecret = (string)$apiSecret;
        $this->sandboxMode = (bool)$sandboxMode;
    }

    //-------------------------------------------------------------------------

    /**
     * @param MessageInterface $message
     */
    public function sendMail(MessageInterface $message)
    {
        $body = [
            'Messages' => [
                $this->createMessage($message),
            ],
        ];

        if ($this->sandboxMode) {
            // The Send API v3.1 allows to run the API call in a Sandbox mode where all the validation
            // of the payload will be done without delivering the message.
            // https://dev.mailjet.com/guides/#sandbox-mode
            $body['SandboxMode'] = true;
        }

        try {
            $response = $this->createMailjetClient()->post(Mailjet\Resources::$Email, ['body' => $body]);

            if (false === $response->success()) {
                throw new RuntimeException($response->getReasonPhrase());
            }
        } catch (\Exception $exception) {
            throw new RuntimeException('Exception raised during sending mail.', $exception->getCode(), $exception);
        }
    }

    //-------------------------------------------------------------------------

    /**
     * @param MessageInterface $message
     * @return array
     */
    private function createMessage(MessageInterface $message)
    {
        $m = [];

        $m['From'] = [
            'Email' => $message->getSender()->getEmail(),
            'Name' => $message->getSender()->getName(),
        ];

        $m['Subject'] = $message->getSubject();

        $m['To'] = [];
        foreach ($message->getRecipients() as $recipient) {
            $m['To'][] = [
                'Email' => $recipient->getEmail(),
                'Name' => $recipient->getName(),
            ];
        }
        unset($recipient);

        if ($message instanceof MailjetMessage) {

            if ($message->isTemplate()) {
                $m['TemplateID'] = $message->getTemplateId();
            } else {
                $m['HTMLPart'] = $message->getMessage();
                $m['TextPart'] = strip_tags($message->getMessage());
            }

            // todo: https://dev.mailjet.com/template-language/sendapi/#templates-error-management
            if ($message->isTemplateErrorDeliver()) {
                $m['TemplateErrorDeliver'] = $message->isTemplateErrorDeliver();
                $m['TemplateErrorReporting'] = $message->getTemplateErrorReportingArray();
            }

            $m['TemplateLanguage'] = $message->isTemplateLanguage();

            if ($message->hasVariables()) {
                $m['Variables'] = $message->getVariables();
            }
        } else {
            $m['HTMLPart'] = $message->getMessage();
            $m['TextPart'] = strip_tags($message->getMessage());
        }

        return $m;
    }

    /**
     * @return Mailjet\Client
     */
    private function createMailjetClient()
    {
        return new Mailjet\Client($this->apiKey, $this->apiSecret, true, ['version' => 'v3.1']);
    }
}
