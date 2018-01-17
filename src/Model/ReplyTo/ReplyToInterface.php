<?php

namespace MassimoFilippi\MailModule\Model\ReplyTo;

/**
 * Interface ReplyToInterface
 * @package MassimoFilippi\MailModule\Model\ReplyTo
 */
interface ReplyToInterface
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
