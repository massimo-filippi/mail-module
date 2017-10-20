<?php

return [
    'massimo_filippi' => [
        'mail_module' => [
            'adapter' => \MassimoFilippi\MailModule\Adapter\Mailjet\MailjetAdapter::class,
            'adapter_params' => [
                'api_key' => '---API-KEY---',
                'api_secret' => '---API-SECRET---',
                'sandbox_mode' => false, // will not send email if true, but API will response
            ],
        ],
    ],
];
