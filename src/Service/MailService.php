<?php

namespace MassimoFilippi\MailModule\Service;

use MassimoFilippi\MailModule\Adapter\AdapterInterface;
use MassimoFilippi\MailModule\Model\Message\MessageInterface;

/**
 * Class MailService
 * @package MassimoFilippi\MailModule\Service
 */
class MailService implements MailServiceInterface
{
    /**
     * @var AdapterInterface
     */
    private $adapter;

    /**
     * MailService constructor.
     * @param AdapterInterface $adapter
     */
    public function __construct(AdapterInterface $adapter)
    {
        $this->adapter = $adapter;
    }

    /**
     * @param MessageInterface $message
     */
    public function sendMail(MessageInterface $message)
    {
        $this->adapter->sendMail($message);
    }
}
