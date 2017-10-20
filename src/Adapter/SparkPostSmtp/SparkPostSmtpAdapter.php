<?php

namespace MassimoFilippi\MailModule\Adapter\SparkPostSmtp;

use MassimoFilippi\MailModule\Adapter\AdapterInterface;
use MassimoFilippi\MailModule\Model\Message\MessageInterface;

/**
 * Class SparkPostSmtpAdapter
 * @package Adapter\SparkPostSmtp
 */
class SparkPostSmtpAdapter implements AdapterInterface
{

    /**
     * @param MessageInterface $message
     */
    public function sendMail(MessageInterface $message)
    {
        // TODO: Implement sendMail() method.
    }
}
