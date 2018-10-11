<?php

namespace MassimoFilippi\MailModule\Service\Factory;

use Interop\Container\ContainerInterface;
use MassimoFilippi\MailModule\Adapter\Google\GoogleSmtpAdapter;
use MassimoFilippi\MailModule\Adapter\Mailjet\MailjetAdapter;
use MassimoFilippi\MailModule\Adapter\SparkPost\SparkPostAdapter;
use MassimoFilippi\MailModule\Adapter\SparkPost\SparkPostSmtpAdapter;
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

        if (false === isset($config['massimo_filippi']['mail_module']['adapter'])) {
            throw new ServiceNotCreatedException('Missing adapter name.');
        }

        $adapterName = $config['massimo_filippi']['mail_module']['adapter'];

        switch ($adapterName) {
            case MailjetAdapter::class:
                $adapter = $container->get(MailjetAdapter::class);
                break;
            case SparkPostAdapter::class:
                $adapter = $container->get(SparkPostAdapter::class);
                break;
            case SparkPostSmtpAdapter::class:
                $adapter = $container->get(SparkPostSmtpAdapter::class);
                break;
            case GoogleSmtpAdapter::class:
                $adapter = $container->get(GoogleSmtpAdapter::class);
                break;
            default:
                throw new ServiceNotCreatedException(sprintf('Adapter "%s" could not be found.', $adapterName));
        }

        return new MailService($adapter);
    }
}
