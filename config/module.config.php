<?php

namespace MassimoFilippi\MailModule;

use MassimoFilippi\MailModule\Adapter\Mailjet\Factory\MailjetAdapterFactory;
use MassimoFilippi\MailModule\Adapter\Mailjet\MailjetAdapter;
use MassimoFilippi\MailModule\Adapter\SparkPostSmtp\Factory\SparkPostSmtpAdapterFactory;
use MassimoFilippi\MailModule\Adapter\SparkPostSmtp\SparkPostSmtpAdapter;

return [
    'service_manager' => [
        'factories' => [
            // services
            Service\MailService::class => Service\Factory\MailServiceFactory::class,

            // adapters
            MailjetAdapter::class => MailjetAdapterFactory::class,
            SparkPostSmtpAdapter::class => SparkPostSmtpAdapterFactory::class,
        ],
    ],
];
