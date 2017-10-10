# mail-module

ZF3 module for e-mail communication

[![Packagist](https://img.shields.io/packagist/v/massimo-filippi/mail-module.svg)](https://packagist.org/packages/massimo-filippi/mail-module)
[![License](http://img.shields.io/:license-mit-blue.svg)](http://doge.mit-license.org)

## Introduction

There will be more info soon...

## Installation

### 1. Install via Composer

Install the latest stable version via Composer:

```
composer require massimo-filippi/mail-module
```

Install the latest develop version via Composer:

```
composer require massimo-filippi/mail-module:dev-develop
```

### 2. Enable module in your application

Composer should enable `MassimoFilippi\MailModule` in your project automatically during installation. 

In case it does not, you can enable module manually by adding value `'MassimoFilippi\MailModule'` to array in file `config/modules.config.php`. At the end, it should look like PHP array below.

You don't have to use this package as Zend Framework module if you don't want to.

```php
<?php

/**
 * List of enabled modules for this application.
 *
 * This should be an array of module namespaces used in the application.
 */
return [
    'Zend\Router',
    'Zend\Validator',
    'MassimoFilippi\MailModule', // Add this line, ideally before Application module.
    'Application',
];
```

### 3. Set up your configuration

You have to set settings for MailService, otherwise you will not be able to use it. 

Here is what I have in my `config/autoload/local.php` file.

*Warning:* DO NOT set passwords in files that are versioned!

```php
<?php
/**
 * Local Configuration Override
 *
 * This configuration override file is for overriding environment-specific and
 * security-sensitive configuration information. Copy this file without the
 * .dist extension at the end and populate values as needed.
 *
 * @NOTE: This file is ignored from Git by default with the .gitignore included
 * in ZendSkeletonApplication. This is a good practice, as it prevents sensitive
 * credentials from accidentally being committed into version control.
 */

return [
    // Config array for modules in MassimoFilippi namespace (our modules).
    'massimo_filippi' => [
        // Config array for MailModule.
        'mail_module' => [
            // Provider you want to use.
            'provider' => \MassimoFilippi\MailModule\Provider\Mailjet\MailjetProvider::class,
            // Provider's parameters needed to create provider's instance (e.g., api key or password).
            'provider_params' => [
                'api_key' => '---API-KEY---',
                'api_secret' => '---API-SECRET---',
                'sandbox_mode' => false, // will not send email if true, but API will response
            ],
        ],
    ],
];
```

## Usage

Somewhere in business logic classes.

```php
<?php 

use MassimoFilippi\MailModule\Provider\Mailjet\MailjetProviderMessage as Message;
use MassimoFilippi\MailModule\Model\Recipient\Recipient;
use MassimoFilippi\MailModule\Model\Sender\Sender;

try {   
    $sender = new Sender('no-reply@example.com', 'Example.com');
     
    $recipient = new Recipient('john.doe@gmail.com');
    $recipient->setName('John Doe');
     
    $message = new Message($sender, $recipient);
     
    $message->setSubject('Test');
     
    $message->setMessage('Hello World!');
     
    $this->mailService->sendMail($message);
} catch (\Exception $exception) {
    var_dump($exception->getMessage());
}
```
