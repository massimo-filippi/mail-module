<?php

namespace MassimoFilippi\MailModule\Model\Attachment;

/**
 * Class Attachment
 * @package MassimoFilippi\MailModule\Model\Attachment
 */
class Attachment implements AttachmentInterface
{

    /**
     * @var string
     */
    protected $name = 'Attachment';

    /**
     * @var string
     */
    protected $type = 'application/octet-stream';

    /**
     * @var string
     */
    protected $data = '';

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Name of file.
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = (string)$name;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * MIME type of file.
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = (string)$type;
    }

    /**
     * @return string
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Base64 encoded file content.
     * @param string $data
     */
    public function setData($data)
    {
        $this->data = (string)$data;
    }
}
