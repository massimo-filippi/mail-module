<?php

namespace MassimoFilippi\MailModule\Adapter\Mailgun;

use MassimoFilippi\MailModule\Adapter\AdapterInterface;
use MassimoFilippi\MailModule\Model\Message\MessageInterface;

/**
 * Class MailgunAdapter
 * @package MassimoFilippi\MailModule\Adapter\Mailgun
 */
class MailgunAdapter implements AdapterInterface
{

    /**
     * @param MessageInterface $message
     */
    public function sendMail(MessageInterface $message)
    {
        // TODO: Implement sendMail() method.
    }
}
