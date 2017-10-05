<?php

namespace MassimoFilippi\MailModule\Provider;

use MassimoFilippi\MailModule\Model\Message\MessageInterface;

/**
 * Interface ProviderInterface
 * @package MassimoFilippi\MailModule\Provider
 */
interface ProviderInterface
{
    /**
     * @param MessageInterface $message
     */
    public function sendMail(MessageInterface $message);
}
