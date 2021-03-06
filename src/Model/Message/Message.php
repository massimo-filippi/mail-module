<?php

namespace MassimoFilippi\MailModule\Model\Message;

use MassimoFilippi\MailModule\Model\Attachment\AttachmentInterface;
use MassimoFilippi\MailModule\Model\Recipient\RecipientInterface;
use MassimoFilippi\MailModule\Model\ReplyTo\ReplyTo;
use MassimoFilippi\MailModule\Model\ReplyTo\ReplyToInterface;
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
    protected $recipientsCc = [];

    /**
     * @var RecipientInterface[]
     */
    protected $recipientsBcc = [];

    /**
     * @var ReplyToInterface[]
     */
    protected $replyTo = [];

    /**
     * @var string
     */
    protected $subject = 'No subject';

    /**
     * @var string
     */
    protected $message = '';

    /**
     * @var array
     */
    protected $attachments = [];

    //-------------------------------------------------------------------------

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

    //-------------------------------------------------------------------------

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
     * @return bool
     */
    public function hasRecipients()
    {
        return false === empty($this->recipients);
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
     * @return bool
     */
    public function hasRecipientsCc()
    {
        return false === empty($this->recipientsCc);
    }

    /**
     * @return RecipientInterface[]
     */
    public function getRecipientsCc()
    {
        return $this->recipientsCc;
    }

    /**
     * @param RecipientInterface $recipient
     */
    public function addRecipientCc(RecipientInterface $recipient)
    {
        $this->recipientsCc[] = $recipient;
    }

    /**
     * @return bool
     */
    public function hasRecipientsBcc()
    {
        return false === empty($this->recipientsBcc);
    }

    /**
     * @return RecipientInterface[]
     */
    public function getRecipientsBcc()
    {
        return $this->recipientsBcc;
    }

    /**
     * @param RecipientInterface $recipient
     */
    public function addRecipientBcc(RecipientInterface $recipient)
    {
        $this->recipientsBcc[] = $recipient;
    }

    /**
     * @return ReplyToInterface[]
     */
    public function getReplyTo()
    {
        return $this->replyTo;
    }

    /**
     * @return bool
     */
    public function hasReplyTo()
    {
        return sizeof($this->replyTo) > 0;
    }

    /**
     * @param ReplyToInterface|ReplyTo[] $replyTo
     */
    public function setReplyTo($replyTo)
    {
        if (is_array($replyTo)) {
            $this->replyTo = $replyTo;
        } else {
            $this->replyTo = [$replyTo];
        }
    }

    /**
     * @param ReplyToInterface $replyTo
     */
    public function addReplyTo(ReplyToInterface $replyTo)
    {
        $this->replyTo[] = $replyTo;
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

    /**
     * Alias to getMessage()
     * @return string
     */
    public function getHtml()
    {
        return $this->getMessage();
    }

    /**
     * @return string
     */
    public function getText()
    {
        return strip_tags($this->getMessage());
    }

    /**
     * @return bool
     */
    public function hasAttachments()
    {
        return !empty($this->attachments);
    }

    /**
     * @return AttachmentInterface[]
     */
    public function getAttachments()
    {
        return $this->attachments;
    }

    /**
     * @param AttachmentInterface $attachment
     */
    public function addAttachment(AttachmentInterface $attachment)
    {
        $this->attachments[] = $attachment;
    }
}
