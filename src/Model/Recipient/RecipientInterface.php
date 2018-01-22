<?php

namespace MassimoFilippi\MailModule\Model\Recipient;

/**
 * Interface RecipientInterface
 * @package MassimoFilippi\MailModule\Model\Recipient
 */
interface RecipientInterface
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
