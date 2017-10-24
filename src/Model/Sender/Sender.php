<?php

namespace MassimoFilippi\MailModule\Model\Sender;

/**
 * Class Sender
 * @package MassimoFilippi\MailModule\Model\Sender
 */
class Sender implements SenderInterface
{
    /**
     * @var string
     */
    protected $email = '';

    /**
     * @var string
     */
    protected $name = '';

    /**
     * Sender constructor.
     * @param string $email
     * @param null|string $name
     */
    public function __construct($email, $name = null)
    {
        $this->setEmail($email);

        if ($name) {
            $this->setName($name);
        }
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = (string)$email;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = (string)$name;
    }
}
