<?php

namespace MassimoFilippi\MailModule\Adapter\SparkPost;

use MassimoFilippi\MailModule\Adapter\AdapterInterface;
use MassimoFilippi\MailModule\Model\Message\MessageInterface;
use Zend\Mail\Message as ZendMessage;
use Zend\Mail\Protocol\Smtp\Auth\Login as ZendProtocolAuthLogin;
use Zend\Mail\Transport\Smtp as ZendTransport;
use Zend\Mail\Transport\SmtpOptions as ZendTransportOptions;

/**
 * Class SparkPostSmtpAdapter
 * @package MassimoFilippi\MailModule\Adapter\SparkPost
 */
class SparkPostSmtpAdapter implements AdapterInterface
{
    const HOST = 'smtp.sparkpostmail.com';
    const PORT = 587;

    /**
     * @var string
     */
    private $sendingDomain = '';

    /**
     * @var string
     */
    private $apiKey = '';

    //-------------------------------------------------------------------------

    /**
     * SparkPostSmtpAdapter constructor.
     * @param string $sendingDomain
     * @param string $apiKey
     */
    public function __construct($sendingDomain, $apiKey)
    {
        $this->setSendingDomain($sendingDomain);
        $this->setApiKey($apiKey);
    }

    //-------------------------------------------------------------------------

    /**
     * @param MessageInterface $message
     */
    public function sendMail(MessageInterface $message)
    {
        $zendMessage = new ZendMessage();

        $zendMessage->setEncoding('UTF-8');

        $sender = $message->getSender();

        $zendMessage->setFrom($sender->getEmail(), $sender->getName());

        foreach ($message->getRecipients() as $recipient) {
            $zendMessage->addTo($recipient->getEmail(), $recipient->getName());
        }
        unset($recipient);

        foreach ($message->getRecipientsCc() as $recipient) {
            $zendMessage->addCc($recipient->getEmail(), $recipient->getName());
        }
        unset($recipient);

        foreach ($message->getRecipientsBcc() as $recipient) {
            $zendMessage->addBcc($recipient->getEmail(), $recipient->getName());
        }
        unset($recipient);

        $zendMessage->setSubject($message->getSubject());
        $zendMessage->setBody($message->getMessage());

        $options = new ZendTransportOptions([
            'name' => $this->sendingDomain,
            'host' => self::HOST,
            'port' => self::PORT,
            'connection_class' => ZendProtocolAuthLogin::class,
            'connection_config' => [
                'username' => 'SMTP_Injection',
                'password' => $this->apiKey,
                'ssl' => 'tls',
            ],
        ]);

        $transport = new ZendTransport($options);
        $transport->send($zendMessage);
    }

    //-------------------------------------------------------------------------

    /**
     * @return string
     */
    public function getSendingDomain()
    {
        return $this->sendingDomain;
    }

    /**
     * @param string $sendingDomain
     */
    public function setSendingDomain($sendingDomain)
    {
        $this->sendingDomain = (string)$sendingDomain;
    }

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
