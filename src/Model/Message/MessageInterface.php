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
     * @param SenderInterface $sender
     */
    public function setSender(SenderInterface $sender);

    /**
     * @return SenderInterface
     */
    public function getSender();

    /**
     * @param RecipientInterface $recipient
     */
    public function addRecipient(RecipientInterface $recipient);

    /**
     * @return RecipientInterface[]
     */
    public function getRecipients();

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
