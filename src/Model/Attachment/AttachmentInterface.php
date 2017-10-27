<?php

namespace MassimoFilippi\MailModule\Model\Attachment;

/**
 * Interface AttachmentInterface
 * @package MassimoFilippi\MailModule\Model\Attachment
 */
interface AttachmentInterface
{

    /**
     * @param $name
     */
    public function setName($name);

    /**
     * @return string
     */
    public function getName();

    /**
     * @param $type
     */
    public function setType($type);

    /**
     * @return string
     */
    public function getType();

    /**
     * @param $data
     */
    public function setData($data);

    /**
     * @return string
     */
    public function getData();
}
