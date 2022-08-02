<?php
namespace App\Service;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class MailService  
{
    public $mailer;

    public function __construct(MailerInterface $mailer)
        {
            $this->mailer =  $mailer;
        }

    public function sendMail(string $from, string $to, string $subject,string $text)
    {
        $message = (new Email())
                ->from($from)
                ->to($to)
                ->subject($subject)
                ->text($text,
                'text/plain');
            $this->mailer->send($message);
    }
}
