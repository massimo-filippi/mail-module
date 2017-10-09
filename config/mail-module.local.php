<?php

return [
    'massimo_filippi' => [
        'mail_module' => [
            'provider' => \MassimoFilippi\MailModule\Provider\Mailjet\MailjetProvider::class,
            'provider_params' => [
                'api_key' => '---API-KEY---',
                'api_secret' => '---API-SECRET---',
            ],
        ],
    ],
];
