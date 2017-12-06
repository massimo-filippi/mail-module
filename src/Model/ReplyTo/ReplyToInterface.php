<?php

namespace MassimoFilippi\MailModule\Model\ReplyTo;

/**
 * Interface ReplyToInterface
 * @package MassimoFilippi\MailModule\Model\ReplyTo
 */
interface ReplyToInterface
{
    /**
     * ReplyToInterface constructor.
     * @param string $email
     * @param string|null $name
     */
    public function __construct($email, $name = null);

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
