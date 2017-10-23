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
     * @var RecipientInterface[]
     */
    protected $recipientsCC = [];

    /**
     * @var RecipientInterface[]
     */
    protected $recipientsBCC = [];

    /**
     * @var string
     */
    protected $subject = 'No subject';

    /**
     * @var string
     */
    protected $message = '';

    /**
     * MessageInterface constructor.
     * @param SenderInterface $sender
     * @param RecipientInterface $recipient
     */
    public function __construct(SenderInterface $sender, RecipientInterface $recipient)
    {
        $this->setSender($sender);
        $this->addRecipient($recipient);
    }

    /**
     * @return SenderInterface
     */
    public function getSender()
    {
        return $this->sender;
    }

    /**
     * @param SenderInterface $sender
     */
    public function setSender(SenderInterface $sender)
    {
        $this->sender = $sender;
    }

    /**
     * @return RecipientInterface[]
     */
    public function getRecipients()
    {
        return $this->recipients;
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
    public function getRecipientsCC()
    {
        return $this->recipientsCC;
    }

    /**
     * @param RecipientInterface $recipient
     */
    public function addRecipientCC(RecipientInterface $recipient)
    {
        $this->recipientsCC[] = $recipient;
    }

    /**
     * @return RecipientInterface[]
     */
    public function getRecipientsBCC()
    {
        return $this->recipientsBCC;
    }

    /**
     * @param RecipientInterface $recipient
     */
    public function addRecipientBCC(RecipientInterface $recipient)
    {
        $this->recipientsBCC[] = $recipient;
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
