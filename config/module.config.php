<?php

namespace MassimoFilippi\MailModule;

return [
    'service_manager' => [
        'factories' => [
            // services
            Service\MailService::class => Service\Factory\MailServiceFactory::class,

            // providers
            Provider\MailjetProvider::class => Provider\Factory\MailjetProviderFactory::class,
        ],
    ],
];
