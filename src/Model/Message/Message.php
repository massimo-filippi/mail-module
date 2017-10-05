<?php

namespace MassimoFilippi\MailModule\Model\Message;

use MassimoFilippi\MailModule\Model\Recipient\RecipientInterface;
use MassimoFilippi\MailModule\Model\Sender\SenderInterface;

/**
 * Class Message
 * @package MassimoFilippi\MailModule\Model\Message
 */
class Message implements MessageInterface
{

    /**
     * @var SenderInterface
     */
    protected $sender = null;

    /**
     * @var RecipientInterface[]
     */
    protected $recipients = [];

    /**
     * @var string
     */
    protected $subject = 'Without subject';

    /**
     * @var string
     */
    protected $message = '';

    /**
     * @param SenderInterface $sender
     */
    public function setSender(SenderInterface $sender)
    {
        $this->sender = $sender;
    }

    /**
     * @return SenderInterface
     */
    public function getSender()
    {
        return $this->sender;
    }

    /**
     * @param RecipientInterface $recipient
     */
    public function addRecipient(RecipientInterface $recipient)
    {
        $this->recipients[] = $recipient;
    }

    /**
     * @return RecipientInterface[]
     */
    public function getRecipients()
    {
        return $this->recipients;
    }

    /**
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @param string $subject
     */
    public function setSubject($subject)
    {
        $this->subject = (string)$subject;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param string $message
     */
    public function setMessage($message)
    {
        $this->message = (string)$message;
    }
}
