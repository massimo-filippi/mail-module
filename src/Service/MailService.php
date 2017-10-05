<?php

namespace MassimoFilippi\MailModule\Service;

use MassimoFilippi\MailModule\Model\Message\MessageInterface;
use MassimoFilippi\MailModule\Provider\ProviderInterface;

/**
 * Class MailService
 * @package MassimoFilippi\MailModule\Service
 */
class MailService implements MailServiceInterface
{
    /**
     * @var ProviderInterface
     */
    private $provider;

    /**
     * MailService constructor.
     * @param ProviderInterface $provider
     */
    public function __construct(ProviderInterface $provider)
    {
        $this->provider = $provider;
    }

    /**
     * @param MessageInterface $message
     */
    public function sendMail(MessageInterface $message)
    {
        $this->provider->sendMail($message);
    }
}
