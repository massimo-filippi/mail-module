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

        if (false === isset($config['massimo_filippi']['mail_module']['adapter_params']['api_key'])) {
            throw new ServiceNotCreatedException('Missing adapter parameter: "api_key".');
        }

        $options = [];

        $options['api_key'] = $config['massimo_filippi']['mail_module']['adapter_params']['api_key'];

        if (array_key_exists('host', $config['massimo_filippi']['mail_module']['adapter_params'])) {
            $options['host'] = $config['massimo_filippi']['mail_module']['adapter_params']['host'];
        }

        if (array_key_exists('port', $config['massimo_filippi']['mail_module']['adapter_params'])) {
            $options['port'] = $config['massimo_filippi']['mail_module']['adapter_params']['port'];
        }

        return new SparkPostSmtpAdapter($options);
    }
}
