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
    'Zend\Mail',
    'Zend\Router',
    'Zend\Validator',
    'MassimoFilippi\MailModule', // Add this line, ideally before Application module.
    'Application',
];
```

### 3. Set up your configuration

At this time you can use 2 services: [SparkPost](https://www.sparkpost.com/) and [Mailjet](https://www.mailjet.com/). Below are examples of my `config/autoload/local.php` file.

**Using MailjetAdapter:**

```php
<?php

return [
    // Config array for modules in MassimoFilippi namespace (our modules).
    'massimo_filippi' => [
        
        // Config array for MailModule.
        'mail_module' => [
            
            // Adapter you want to use.
            'adapter' => \MassimoFilippi\MailModule\Adapter\Mailjet\MailjetAdapter::class,
            
            // Adapter's parameters needed to create adapter's instance (e.g., api key or password).
            'adapter_params' => [
                'api_key' => '---API-KEY---',
                'api_secret' => '---API-SECRET---',
                'sandbox_mode' => false, // will not send email if true, but API will response
            ],
        ],
    ],
];
```

**Using SparkPostAdapter:**

```php
<?php

return [
    // Config array for modules in MassimoFilippi namespace (our modules).
    'massimo_filippi' => [
        
        // Config array for MailModule.
        'mail_module' => [
            
            // Adapter you want to use.
            'adapter' => \MassimoFilippi\MailModule\Adapter\SparkPost\SparkPostAdapter::class,
            
            // Adapter's parameters needed to create adapter's instance (e.g., api key or password).
            'adapter_params' => [
                'api_key' => '---API-KEY---',
            ],
        ],
    ],
];
```

**Using SparkPostSmtpAdapter:**

```php
<?php

return [
    // Config array for modules in MassimoFilippi namespace (our modules).
    'massimo_filippi' => [
        
        // Config array for MailModule.
        'mail_module' => [
            
            // Adapter you want to use.
            'adapter' => \MassimoFilippi\MailModule\Adapter\SparkPost\SparkPostSmtpAdapter::class,
            
            // Adapter's parameters needed to create adapter's instance (e.g., api key or password).
            'adapter_params' => [
                'api_key' => '---SMTP-API-KEY---',
            ],
        ],
    ],
];
```

## Usage

Somewhere in business logic classes. Usage should be always the same.

```php
<?php 

use MassimoFilippi\MailModule\Model\Message\Message;
use MassimoFilippi\MailModule\Model\Recipient\Recipient;
use MassimoFilippi\MailModule\Model\Sender\Sender;

try {   
    // Remember that some services need sender's email address enabled first!
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
