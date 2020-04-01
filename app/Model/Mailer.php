<?php


namespace MyteamStats\Model;


class Mailer
{


    public function __construct($receivers,$title, $message)
    {
        $this->receivers = $receivers;
        $this->title = $title;
        $this->message = $message;
        $this->username = 'myTeamStats@thibaut-minard.fr';
        $this->userpwd = 'Oh7811bm!=';
        $this->encryption = 'tls';
        $this->smtp = 'smtp.ionos.com';
        $this->port = 587;
        $this->from = 'myTeamStats@thibaut-minard.fr';
        $this->alias = 'Henry de MyTeamStats';

        $this->sendMail();
    }

    public function setTransport(){
        $transport = (new \Swift_SmtpTransport($this->smtp, $this->port))
            ->setUsername($this->username)
            ->setPassword($this->userpwd)
            ->setEncryption($this->encryption)
        ;

        return $transport;
    }

    public function createMailer($transport){
        $mailer = new \Swift_Mailer($transport);

        return $mailer;
    }

    public function createMessage(){
        $message = (new \Swift_Message($this->title))
            ->setFrom([$this->from => $this->alias])
            ->setTo([$this->receivers])
            ->SetBcc($this->from)
            ->setBody($this->message);
        ;

        return $message;
    }

    public function sendMail(){
        $transport = $this->setTransport();
        $mailer = $this->createMailer($transport);
        $message = $this->createMessage();

        $result = $mailer->send($message);
        print_r($result);
    }
}