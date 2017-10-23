<?php

namespace MassimoFilippi\MailModule\Model\Message;

use MassimoFilippi\MailModule\Model\Recipient\RecipientInterface;
use MassimoFilippi\MailModule\Model\Sender\SenderInterface;

/**
 * Interface MessageInterface
 * @package MassimoFilippi\MailModule\Model\Message
 */
interface MessageInterface
{
    /**
     * MessageInterface constructor.
     * @param SenderInterface $sender
     * @param RecipientInterface $recipient
     */
    public function __construct(SenderInterface $sender, RecipientInterface $recipient);

    /**
     * @return SenderInterface
     */
    public function getSender();

    /**
     * @param SenderInterface $sender
     */
    public function setSender(SenderInterface $sender);

    /**
     * @return RecipientInterface[]
     */
    public function getRecipients();

    /**
     * @param RecipientInterface $recipient
     */
    public function addRecipient(RecipientInterface $recipient);

    /**
     * @return RecipientInterface[]
     */
    public function getRecipientsCC();

    /**
     * @param RecipientInterface $recipient
     */
    public function addRecipientCC(RecipientInterface $recipient);

    /**
     * @return RecipientInterface[]
     */
    public function getRecipientsBCC();

    /**
     * @param RecipientInterface $recipient
     */
    public function addRecipientBCC(RecipientInterface $recipient);

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
}
