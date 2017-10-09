<?php

return [
    'massimo_filippi' => [
        'mail_module' => [
            'provider' => \MassimoFilippi\MailModule\Provider\Mailjet\MailjetProvider::class,
            'provider_params' => [
                'api_key' => '---API-KEY---',
                'api_secret' => '---API-SECRET---',
                'sandbox_mode' => false, // will not send email if true, but API will response
            ],
        ],
    ],
];
