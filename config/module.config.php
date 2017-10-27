<?php

namespace MassimoFilippi\MailModule;

use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'service_manager' => [
        'factories' => [
            // services
            Service\MailService::class => Service\Factory\MailServiceFactory::class,

            // adapters
            Adapter\Mailjet\MailjetAdapter::class => Adapter\Mailjet\Factory\MailjetAdapterFactory::class,
            Adapter\Sendmail\SendmailAdapter::class => InvokableFactory::class,
            Adapter\SparkPost\SparkPostAdapter::class => Adapter\SparkPost\Factory\SparkPostAdapterFactory::class,
            Adapter\SparkPost\SparkPostSmtpAdapter::class => Adapter\SparkPost\Factory\SparkPostSmtpAdapterFactory::class,
        ],
    ],
];
