<?php

namespace MassimoFilippi\MailModule\Adapter\Mailjet\Factory;

use Interop\Container\ContainerInterface;
use MassimoFilippi\MailModule\Adapter\Mailjet\MailjetAdapter;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Class MailjetAdapterFactory
 * @package MassimoFilippi\MailModule\Adapter\Mailjet\Factory
 */
class MailjetAdapterFactory implements FactoryInterface
{

    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return MailjetAdapter
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {

        /** @var array $config */
        $config = $container->get('Config');

        if (false === isset($config['massimo_filippi']['mail_module']['adapter_params']['api_key'])) {
            throw new ServiceNotCreatedException('Missing adapter parameter: "api_key".');
        }

        if (false === isset($config['massimo_filippi']['mail_module']['adapter_params']['api_secret'])) {
            throw new ServiceNotCreatedException('Missing adapter parameter: "api_secret".');
        }

        $options = [];

        $options['api_key'] = $config['massimo_filippi']['mail_module']['adapter_params']['api_key'];
        $options['api_secret'] = $config['massimo_filippi']['mail_module']['adapter_params']['api_secret'];

        if (true === isset($config['massimo_filippi']['mail_module']['adapter_params']['sandbox_mode'])) {
            $options['sandbox_mode'] = $config['massimo_filippi']['mail_module']['adapter_params']['sandbox_mode'];
        }

        return new MailjetAdapter($options);
    }
}
