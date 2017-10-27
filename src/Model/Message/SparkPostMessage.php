<?php

namespace MassimoFilippi\MailModule\Model\Message;

/**
 * Class SparkPostMessage
 * @package MassimoFilippi\MailModule\Model\Message
 */
class SparkPostMessage extends Message implements MessageInterface
{

    /**
     * @var bool
     */
    protected $template = false;

    /**
     * @var string
     */
    protected $templateId = '';

    //-------------------------------------------------------------------------

    /**
     * @return bool
     */
    public function isTemplate()
    {
        return $this->template;
    }

    /**
     * @param bool $template
     */
    public function setTemplate($template)
    {
        $this->template = (bool)$template;
    }

    /**
     * @return string
     */
    public function getTemplateId()
    {
        return $this->templateId;
    }

    /**
     * @param string $templateId
     */
    public function setTemplateId($templateId)
    {
        $this->templateId = (string)$templateId;
    }
}
