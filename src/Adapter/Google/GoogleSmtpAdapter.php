<?php

namespace MassimoFilippi\MailModule\Adapter\Google;

use MassimoFilippi\MailModule\Adapter\AdapterInterface;
use MassimoFilippi\MailModule\Model\Message\MessageInterface;
use MassimoFilippi\MailModule\Model\ReplyTo\ReplyTo;
use Zend\Mail\Message as ZendMessage;
use Zend\Mail\Protocol\Smtp\Auth\Login as ZendProtocolAuthLogin;
use Zend\Mail\Transport\Smtp as ZendTransport;
use Zend\Mail\Transport\SmtpOptions as ZendTransportOptions;

/**
 * Class GoogleSmtpAdapter
 */
class GoogleSmtpAdapter implements AdapterInterface
{
    const HOST = 'smtp.gmail.com';

    /**
     * @var string
     */
    private $username = '';

    /**
     * @var string
     */
    private $password = '';

    /**
     * @var string
     */
    private $ssl = 'tls';

    //-------------------------------------------------------------------------

    /**
     * GoogleSmtpAdapter constructor.
     * @param array $options
     */
    public function __construct(array $options)
    {
        if (array_key_exists('username', $options)) {
            $this->setUsername($options['username']);
        }

        if (array_key_exists('password', $options)) {
            $this->setPassword($options['password']);
        }

        if (array_key_exists('ssl', $options)) {
            $this->setSsl($options['ssl']);
        }
    }

    //-------------------------------------------------------------------------

    /**
     * @param MessageInterface $message
     */
    public function sendMail(MessageInterface $message)
    {
        $zendMessage = new ZendMessage();

        $zendMessage->setEncoding('UTF-8');

        if ($message->getMessage() !== strip_tags($message->getMessage())) {
            $headers = $zendMessage->getHeaders();
            $headers->removeHeader('Content-Type');
            $headers->addHeaderLine('Content-Type', 'text/html; charset=UTF-8');
        }


        $sender = $message->getSender();

        $zendMessage->setFrom($sender->getEmail(), $sender->getName());

        foreach ($message->getRecipients() as $recipient) {
            $zendMessage->addTo($recipient->getEmail(), $recipient->getName());
        }
        unset($recipient);

        if ($message->hasRecipientsCc()) {
            foreach ($message->getRecipientsCc() as $recipient) {
                $zendMessage->addCc($recipient->getEmail(), $recipient->getName());
            }
            unset($recipient);
        }

        if ($message->hasRecipientsBcc()) {
            foreach ($message->getRecipientsBcc() as $recipient) {
                $zendMessage->addBcc($recipient->getEmail(), $recipient->getName());
            }
            unset($recipient);
        }

        if($message->hasReplyTo()) {
            /** @var ReplyTo $replyTo */
            $replyTo = current($message->getReplyTo());

            $zendMessage->setReplyTo($replyTo->getEmail(), !empty($replyTo->getName()) ? $replyTo->getName() : null);
        }

        $zendMessage->setSubject($message->getSubject());
        $zendMessage->setBody($message->getMessage());

        $options = new ZendTransportOptions([
            'host' => self::HOST,
            'port' => $this->getPort(),
            'connection_class' => ZendProtocolAuthLogin::class,
            'connection_config' => [
                'username' => $this->getUsername(),
                'password' => $this->getPassword(),
                'ssl' => $this->getSsl(),
            ],
        ]);

        $transport = new ZendTransport($options);
        $transport->send($zendMessage);
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getSsl(): string
    {
        return $this->ssl;
    }

    /**
     * @param string $ssl
     */
    public function setSsl(string $ssl): void
    {
        $this->ssl = $ssl;
    }

    protected function getPort(): int
    {
        switch ($this->getSsl())
        {
            case 'ssl' : return 465;
            case 'tls' : return 587;
            default: return 25;
        }
    }
}
