<?php

namespace MassimoFilippi\MailModule\Model\Recipient;

/**
 * Class Recipient
 * @package MassimoFilippi\MailModule\Model\Recipient
 */
class Recipient implements RecipientInterface
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
     * Recipient constructor.
     * @param string $email
     * @param null|string $name
     */
    public function __construct($email, $name = null)
    {
        $this->setEmail($email);

        if ($name) {
            $this->setName($this->name);
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
