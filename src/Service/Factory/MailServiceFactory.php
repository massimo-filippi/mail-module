<?php

namespace MassimoFilippi\MailModule\Service\Factory;

use Interop\Container\ContainerInterface;
use MassimoFilippi\MailModule\Provider\Mailjet\MailjetProvider;
use MassimoFilippi\MailModule\Service\MailService;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Class MailServiceFactory
 * @package MassimoFilippi\MailModule\Service\Factory
 */
class MailServiceFactory implements FactoryInterface
{

    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return MailService
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {

        /** @var array $config */
        $config = $container->get('Config');

        if (false === isset($config['massimo_filippi']['mail_module'])) {
            throw new ServiceNotCreatedException('Missing configuration for mail module.');
        }

        if (false === isset($config['massimo_filippi']['mail_module']['provider'])) {
            throw new ServiceNotCreatedException('Missing provider name.');
        }

        $providerName = $config['massimo_filippi']['mail_module']['provider'];

        switch ($providerName) {
            case MailjetProvider::class:
                $provider = $container->get(MailjetProvider::class);
                break;
            default:
                throw new ServiceNotCreatedException(sprintf('Provider "%s" could not be found.', $providerName));
        }

        return new MailService($provider);
    }
}
