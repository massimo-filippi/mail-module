<?php

namespace MassimoFilippi\MailModule\Adapter\Mailgun\Factory;

use Interop\Container\ContainerInterface;
use MassimoFilippi\MailModule\Adapter\Mailgun\MailgunAdapter;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Class MailgunAdapterFactory
 * @package MassimoFilippi\MailModule\Adapter\Mailgun\Factory
 */
class MailgunAdapterFactory implements FactoryInterface
{

    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return MailgunAdapter
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new MailgunAdapter();
    }
}
