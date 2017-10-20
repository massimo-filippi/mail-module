<?php

namespace MassimoFilippi\MailModule\Adapter;

use MassimoFilippi\MailModule\Model\Message\MessageInterface;

/**
 * Interface AdapterInterface
 * @package MassimoFilippi\MailModule\Adapter
 */
interface AdapterInterface
{
    /**
     * @param MessageInterface $message
     */
    public function sendMail(MessageInterface $message);
}
