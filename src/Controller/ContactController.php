<?php

namespace App\Controller;

use App\Form\ContactType;
use App\Repository\PhotoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mailer\MailerInterface;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */
    public function index(Request $request, MailerInterface $mailer, PhotoRepository $photoRepository)
    {
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);


        if($form->isSubmitted() && $form->isValid()) {

            $contactFormData = $form->getData();
            
            $message = (new Email())
                ->from($contactFormData['nom'].' '.$contactFormData['prenom'].' <'.$contactFormData['email'].'>')
                ->to('gestion.hypnos@gmail.com')
                ->subject($contactFormData['objet'].' '.$contactFormData['nom'].' '.$contactFormData['prenom'])
                ->text('Sender : '.$contactFormData['email'].\PHP_EOL.
                    $contactFormData['message'],
                    'text/plain');
            $mailer->send($message);

            $confirmMessage = (new Email())
                ->from('Hypnos <'.$contactFormData['email'].'>')
                ->to($contactFormData['email'])
                ->subject($contactFormData['objet'].' '.$contactFormData['nom'].' '.$contactFormData['prenom'])
                ->text('Votre message a bien était envoyé'.\PHP_EOL.
                'Récapitulatif du message : '.\PHP_EOL.$contactFormData['message'],
                    'text/plain');
            $mailer->send($confirmMessage);


            $this->addFlash('success', 'Votre message a été envoyé');

            return $this->redirectToRoute('contact');
        }

        return $this->render('contact/index.html.twig', [
            'photos' => $photoRepository->findAll(),
            'form' => $form->createView()
        ]);
    }
    
}
