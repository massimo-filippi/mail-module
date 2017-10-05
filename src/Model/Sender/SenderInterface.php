<?php

namespace MassimoFilippi\MailModule\Model\Sender;

/**
 * Interface SenderInterface
 * @package MassimoFilippi\MailModule\Model\Sender
 */
interface SenderInterface
{
    /**
     * @return string
     */
    public function getEmail();

    /**
     * @param string $email
     */
    public function setEmail($email);

    /**
     * @return string
     */
    public function getName();

    /**
     * @param string $name
     */
    public function setName($name);
}
