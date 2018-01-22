<?php

namespace MassimoFilippi\MailModule\Model\Message;

use MassimoFilippi\MailModule\Model\Attachment\AttachmentInterface;
use MassimoFilippi\MailModule\Model\Recipient\RecipientInterface;
use MassimoFilippi\MailModule\Model\ReplyTo\ReplyToInterface;
use MassimoFilippi\MailModule\Model\Sender\SenderInterface;

/**
 * Interface MessageInterface
 * @package MassimoFilippi\MailModule\Model\Message
 */
interface MessageInterface
{

    /**
     * @return SenderInterface
     */
    public function getSender();

    /**
     * @param SenderInterface $sender
     */
    public function setSender(SenderInterface $sender);

    /**
     * @return bool
     */
    public function hasRecipients();

    /**
     * @return RecipientInterface[]
     */
    public function getRecipients();

    /**
     * @param RecipientInterface $recipient
     */
    public function addRecipient(RecipientInterface $recipient);

    /**
     * @return bool
     */
    public function hasRecipientsCc();

    /**
     * @return RecipientInterface[]
     */
    public function getRecipientsCc();

    /**
     * @param RecipientInterface $recipient
     */
    public function addRecipientCc(RecipientInterface $recipient);

    /**
     * @return bool
     */
    public function hasRecipientsBcc();

    /**
     * @return RecipientInterface[]
     */
    public function getRecipientsBcc();

    /**
     * @param RecipientInterface $recipient
     */
    public function addRecipientBcc(RecipientInterface $recipient);

    /**
     * @return ReplyToInterface[]
     */
    public function getReplyTo();

    /**
     * @return bool
     */
    public function hasReplyTo();

    /**
     * @param ReplyToInterface[] $replyTo
     */
    public function setReplyTo($replyTo);

    /**
     * @param ReplyToInterface $replyTo
     */
    public function addReplyTo(ReplyToInterface $replyTo);

    /**
     * @return string
     */
    public function getSubject();

    /**
     * @param string $subject
     */
    public function setSubject($subject);

    /**
     * @return string
     */
    public function getMessage();

    /**
     * @param string $message
     */
    public function setMessage($message);

    /**
     * @return string
     */
    public function getHtml();

    /**
     * @return string
     */
    public function getText();

    /**
     * @return bool
     */
    public function hasAttachments();

    /**
     * @return array
     */
    public function getAttachments();

    /**
     * @param AttachmentInterface $attachment
     */
    public function addAttachment(AttachmentInterface $attachment);
}
