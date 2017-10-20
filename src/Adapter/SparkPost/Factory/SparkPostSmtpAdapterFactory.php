<?php

namespace MassimoFilippi\MailModule\Adapter\SparkPost\Factory;

use Interop\Container\ContainerInterface;
use MassimoFilippi\MailModule\Adapter\SparkPost\SparkPostSmtpAdapter;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Class SparkPostSmtpAdapterFactory
 * @package MassimoFilippi\MailModule\Adapter\SparkPost\Factory
 */
class SparkPostSmtpAdapterFactory implements FactoryInterface
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

        if (false === isset($config['massimo_filippi']['mail_module']['adapter_params']['name'])) {
            throw new ServiceNotCreatedException('Missing adapter parameter: "name".');
        }

        if (false === isset($config['massimo_filippi']['mail_module']['adapter_params']['password'])) {
            throw new ServiceNotCreatedException('Missing adapter parameter: "password".');
        }

        $name = $config['massimo_filippi']['mail_module']['adapter_params']['name'];
        $password = $config['massimo_filippi']['mail_module']['adapter_params']['password'];

        return new SparkPostSmtpAdapter($name, $password);
    }
}
