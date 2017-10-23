<?php

namespace MassimoFilippi\MailModule\Adapter\SparkPost\Factory;

use Interop\Container\ContainerInterface;
use MassimoFilippi\MailModule\Adapter\SparkPost\SparkPostAdapter;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Class SparkPostAdapterFactory
 * @package MassimoFilippi\MailModule\Adapter\SparkPost\Factory
 */
class SparkPostAdapterFactory implements FactoryInterface
{

    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return SparkPostAdapter
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

        return new SparkPostAdapter($options);
    }
}
