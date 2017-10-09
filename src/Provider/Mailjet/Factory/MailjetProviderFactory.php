<?php

namespace MassimoFilippi\MailModule\Provider\Mailjet\Factory;

use Interop\Container\ContainerInterface;
use MassimoFilippi\MailModule\Provider\Mailjet\MailjetProvider;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Class MailjetProviderFactory
 * @package MassimoFilippi\MailModule\Provider\Mailjet\Factory
 */
class MailjetProviderFactory implements FactoryInterface
{

    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return MailjetProvider
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        /** @var array $config */
        $config = $container->get('Config');

        if (false === isset($config['massimo_filippi']['mail_module']['provider_params']['api_key'])) {
            throw new ServiceNotCreatedException('Missing provider parameter: "api_key".');
        }

        $apiKey = $config['massimo_filippi']['mail_module']['provider_params']['api_key'];

        if (false === isset($config['massimo_filippi']['mail_module']['provider_params']['api_secret'])) {
            throw new ServiceNotCreatedException('Missing provider parameter: "api_secret".');
        }

        $apiSecret = $config['massimo_filippi']['mail_module']['provider_params']['api_secret'];

        $sandboxMode = false;

        if (true === isset($config['massimo_filippi']['mail_module']['provider_params']['sandbox_mode'])) {
            $sandboxMode = $config['massimo_filippi']['mail_module']['provider_params']['sandbox_mode'];
        }

        return new MailjetProvider($apiKey, $apiSecret, $sandboxMode);
    }
}
