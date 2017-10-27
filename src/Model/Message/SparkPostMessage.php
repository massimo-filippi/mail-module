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

    /**
     * @var array
     */
    protected $substitutionData = [];

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

    /**
     * @return bool
     */
    public function hasSubstitutionData()
    {
        return !empty($this->substitutionData);
    }

    /**
     * @return array
     */
    public function getSubstitutionData()
    {
        return $this->substitutionData;
    }

    /**
     * @param array $substitutionData
     */
    public function setSubstitutionData(array $substitutionData)
    {
        $this->substitutionData = $substitutionData;
    }
}
