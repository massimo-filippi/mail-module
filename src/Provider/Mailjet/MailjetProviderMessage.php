<?php

namespace MassimoFilippi\MailModule\Provider\Mailjet;

use MassimoFilippi\MailModule\Model\Message\Message;
use MassimoFilippi\MailModule\Model\Message\MessageInterface;

/**
 * Class MailjetProviderMessage
 * @package MassimoFilippi\MailModule\Provider\Mailjet
 */
class MailjetProviderMessage extends Message implements MessageInterface
{
    /**
     * @var array
     */
    protected $variables = [];

    /**
     * @var bool
     */
    protected $template = false;

    /**
     * @var int
     */
    protected $templateId = 0;

    /**
     * @var bool
     */
    protected $templateLanguage = false;

    /**
     * @var bool
     */
    protected $templateErrorDeliver = false;

    /**
     * @var array
     */
    protected $templateErrorReporting = [];

    /**
     * @return bool
     */
    public function hasVariables()
    {
        return false === empty($this->variables);
    }

    /**
     * @return array
     */
    public function getVariables()
    {
        return $this->variables;
    }

    /**
     * @param string $key
     * @param mixed $value
     */
    public function setVariable($key, $value)
    {
        $this->variables[(string)$key] = $value;
    }

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
     * @return int
     */
    public function getTemplateId()
    {
        return $this->templateId;
    }

    /**
     * @param int $templateId
     */
    public function setTemplateId($templateId)
    {
        $this->templateId = (int)$templateId;
    }

    /**
     * @return bool
     */
    public function isTemplateLanguage()
    {
        return $this->templateLanguage;
    }

    /**
     * @param bool $templateLanguage
     */
    public function setTemplateLanguage($templateLanguage)
    {
        $this->templateLanguage = (bool)$templateLanguage;
    }

    /**
     * @return bool
     */
    public function isTemplateErrorDeliver()
    {
        return $this->templateErrorDeliver;
    }

    /**
     * @param bool $templateErrorDeliver
     */
    public function setTemplateErrorDeliver($templateErrorDeliver)
    {
        $this->templateErrorDeliver = (bool)$templateErrorDeliver;
    }

    /**
     * @return array
     */
    public function getTemplateErrorReportingArray()
    {
        return $this->templateErrorReporting;
    }

    /**
     * @param string $templateErrorReportingEmail
     */
    public function setTemplateErrorReportingEmail($templateErrorReportingEmail)
    {
        $this->templateErrorReporting['Email'] = (string)$templateErrorReportingEmail;
    }

    /**
     * @param string $templateErrorReportingName
     */
    public function setTemplateErrorReportingName($templateErrorReportingName)
    {
        $this->templateErrorReporting['Name'] = $templateErrorReportingName;
    }
}
