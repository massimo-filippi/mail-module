<?php

namespace MassimoFilippi\MailModule;

return [
    'service_manager' => [
        'factories' => [
            // services
            Service\MailService::class => Service\Factory\MailServiceFactory::class,

            // adapters
            Adapter\Mailjet\MailjetAdapter::class => Adapter\Mailjet\Factory\MailjetAdapterFactory::class,
            Adapter\SparkPost\SparkPostSmtpAdapter::class => Adapter\SparkPost\Factory\SparkPostSmtpAdapterFactory::class,
        ],
    ],
];
