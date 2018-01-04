<?php
/**
 * Created by PhpStorm.
 * User: cedricleblond
 * Date: 02/01/18
 * Time: 20:20
 */

namespace SiteSupervisionBundle\Service;


class MessageGenerator
{
    private $messageGenerator;
    private $mailer;
    private $to;
    private $message;
    
    
    public function __construct(MessageGenerator $messageGenerator, \Swift_Mailer $mailer, $to, $message)
    {
        $this->messageGenerator = $messageGenerator;
        $this->mailer = $mailer;
        $this->to = $to;
        $this->message = $message;
    }

    public function sendMessage()
    {
        $mail = \Swift_Message::newInstance()
            ->setSubject('Création compte')
            ->setFrom('administrator@capvisu.com')
            ->setTo($this->to)
            ->addPart($this->message);
        $this->mailer->send($mail);

    }
}