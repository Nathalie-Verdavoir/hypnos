<?php

namespace App\Service;

use Symfony\Component\Mailer\MailerInterface;

class ContactMailService
{
    private string $from;
    private string $to;
    private string $subject;
    private string $text;
    private string $confirmFrom;
    private string $confirmTo;
    private string $confirmText;

    public function __construct(array $contactFormData)
    {
        $this->from = $contactFormData['nom'] . ' ' . $contactFormData['prenom'] . ' <' . $contactFormData['email'] . '>';
        $this->to = 'gestion.hypnos@gmail.com';
        $this->subject = $contactFormData['objet'] . ' ' . $contactFormData['nom'] . ' ' . $contactFormData['prenom'];
        $this->text = 'Sender : ' . $contactFormData['email'] . \PHP_EOL .
            $contactFormData['message'];
        $this->confirmFrom = 'Hypnos <' . $contactFormData['email'] . '>';
        $this->confirmTo = $contactFormData['email'];
        $this->confirmText = 'Votre message a bien était envoyé' . \PHP_EOL .
            'Récapitulatif du message : ' . \PHP_EOL . $contactFormData['message'];
    }
    public function sendFromContactFormData(MailerInterface $mailer)
    {
        $mailService = new MailService($mailer);
        //send the mail 
        $mailService->sendMail($this->from, $this->to, $this->subject, $this->text);
        //send the confirm message
        $mailService->sendMail($this->confirmFrom, $this->confirmTo, $this->subject, $this->confirmText);
    }
}
