<?php

namespace MassimoFilippi\MailModule\Adapter\Mailjet;

use MassimoFilippi\MailModule\Adapter\AdapterInterface;
use MassimoFilippi\MailModule\Exception\RuntimeException;
use MassimoFilippi\MailModule\Model\Message\MailjetMessage;
use MassimoFilippi\MailModule\Model\Message\MessageInterface;
use Mailjet;
use MassimoFilippi\MailModule\Model\ReplyTo\ReplyToInterface;

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
     * @param array $options
     */
    public function __construct(array $options)
    {
        if (array_key_exists('api_key', $options)) {
            $this->setApiKey($options['api_key']);
        }

        if (array_key_exists('api_secret', $options)) {
            $this->setApiSecret($options['api_secret']);
        }

        if (array_key_exists('sandbox_mode', $options)) {
            $this->setSandboxMode($options['sandbox_mode']);
        }
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

        if ($this->isSandboxMode()) {
            // The Send API v3.1 allows to run the API call in a Sandbox mode where all the validation
            // of the payload will be done without delivering the message.
            // https://dev.mailjet.com/guides/#sandbox-mode
            $body['SandboxMode'] = true;
        }

        try {
            $mailjetClient = $this->createMailjetClient();

            $response = $mailjetClient->post(Mailjet\Resources::$Email, ['body' => $body]);

            if (false === $response->success()) {
                throw new RuntimeException($response->getReasonPhrase());
            }
        } catch (\Exception $exception) {
            throw new RuntimeException('Exception raised during sending mail.', $exception->getCode(), $exception);
        }
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

    /**
     * @return string
     */
    public function getApiSecret()
    {
        return $this->apiSecret;
    }

    /**
     * @param string $apiSecret
     */
    public function setApiSecret($apiSecret)
    {
        $this->apiSecret = (string)$apiSecret;
    }

    /**
     * @return bool
     */
    public function isSandboxMode()
    {
        return $this->sandboxMode;
    }

    /**
     * @param bool $sandboxMode
     */
    public function setSandboxMode($sandboxMode)
    {
        $this->sandboxMode = (bool)$sandboxMode;
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

        if ($message->hasRecipientsCc()) {
            $m['Cc'] = [];
            foreach ($message->getRecipientsCc() as $recipient) {
                $m['Cc'][] = [
                    'Email' => $recipient->getEmail(),
                    'Name' => $recipient->getName(),
                ];
            }
            unset($recipient);
        }

        if ($message->hasRecipientsBcc()) {
            $m['Bcc'] = [];
            foreach ($message->getRecipientsBcc() as $recipient) {
                $m['Bcc'][] = [
                    'Email' => $recipient->getEmail(),
                    'Name' => $recipient->getName(),
                ];
            }
            unset($recipient);
        }

        if($message->hasReplyTo()) {
            /** @var ReplyToInterface $replyTo */
            $replyTo = current($message->getReplyTo());

            // MailJet API v3
//            if(!isset($m['Headers'])) {
//                $m['Headers'] = [];
//            }

//            if(!empty($replyTo->getName())) {
//                $m['Headers']['Reply-To'] = $replyTo->getName() . ' <' . $replyTo->getEmail() . '>';
//            } else {
//                $m['Headers']['Reply-To'] = $replyTo->getEmail();
//            }

            // MailJet API v3.1
            $m['ReplyTo'] = [
                'Email' => $replyTo->getEmail(),
                'Name' => $replyTo->getName()
            ];
        }

        if ($message instanceof MailjetMessage) {

            if ($message->isTemplate()) {
                $m['TemplateID'] = $message->getTemplateId();
            } else {
                $m['HTMLPart'] = $message->getHtml();
                $m['TextPart'] = $message->getText();
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

            if ($message->hasAttachments()) {
                $m['Attachments'] = [];

                foreach ($message->getAttachments() as $attachment) {
                    $m['Attachments'][] = [
                        'ContentType' => $attachment->getType(),
                        'Filename' => $attachment->getName(),
                        'Base64Content' => $attachment->getData(),
                    ];
                }
            }
        } else {
            $m['HTMLPart'] = $message->getHtml();
            $m['TextPart'] = $message->getText();
        }

        return $m;
    }

    /**
     * @return Mailjet\Client
     */
    private function createMailjetClient()
    {
        return new Mailjet\Client($this->getApiKey(), $this->getApiSecret(), true, ['version' => 'v3.1']);
    }
}
