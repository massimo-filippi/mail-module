<?php

namespace MassimoFilippi\MailModule\Adapter\Google\Factory;

use Interop\Container\ContainerInterface;
use MassimoFilippi\MailModule\Adapter\Google\GoogleSmtpAdapter;
use MassimoFilippi\MailModule\Adapter\SparkPost\SparkPostSmtpAdapter;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Class GoogleSmtpAdapterFactory
 */
class GoogleSmtpAdapterFactory implements FactoryInterface
{

    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return SparkPostSmtpAdapter
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {

        /** @var array $config */
        $config = $container->get('Config');

        if (false === isset($config['massimo_filippi']['mail_module']['adapter_params']['username'])) {
            throw new ServiceNotCreatedException('Missing adapter parameter: "username".');
        }

        if (false === isset($config['massimo_filippi']['mail_module']['adapter_params']['password'])) {
            throw new ServiceNotCreatedException('Missing adapter parameter: "password".');
        }

        $options = [];

        $options['username'] = $config['massimo_filippi']['mail_module']['adapter_params']['username'];
        $options['password'] = $config['massimo_filippi']['mail_module']['adapter_params']['password'];
        $options['ssl'] = $config['massimo_filippi']['mail_module']['adapter_params']['ssl'] ?: 'tls';

        return new GoogleSmtpAdapter($options);
    }
}
