<?php

namespace MassimoFilippi\MailModule\Adapter\Sendmail;

use MassimoFilippi\MailModule\Adapter\AdapterInterface;
use MassimoFilippi\MailModule\Model\Message\MessageInterface;
use Zend\Mail\Message as ZendMessage;
use Zend\Mail\Transport\Sendmail as ZendTransport;

/**
 * Class SendmailAdapter
 * @package MassimoFilippi\MailModule\Adapter\Sendmail
 */
class SendmailAdapter implements AdapterInterface
{

    /**
     * @param MessageInterface $message
     */
    public function sendMail(MessageInterface $message)
    {
        $zendMessage = new ZendMessage();

        $zendMessage->setEncoding('UTF-8');

        $sender = $message->getSender();

        $zendMessage->setFrom($sender->getEmail(), $sender->getName());

        foreach ($message->getRecipients() as $recipient) {
            $zendMessage->addTo($recipient->getEmail(), $recipient->getName());
        }
        unset($recipient);

        if ($message->hasRecipientsCc()) {
            foreach ($message->getRecipientsCc() as $recipient) {
                $zendMessage->addCc($recipient->getEmail(), $recipient->getName());
            }
            unset($recipient);
        }

        if ($message->hasRecipientsBcc()) {
            foreach ($message->getRecipientsBcc() as $recipient) {
                $zendMessage->addBcc($recipient->getEmail(), $recipient->getName());
            }
            unset($recipient);
        }

        $zendMessage->setSubject($message->getSubject());
        $zendMessage->setBody($message->getMessage());

        $transport = new ZendTransport();
        $transport->send($zendMessage);
    }
}
