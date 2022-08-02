<?php

namespace App\Controller;

use App\Form\ContactType;
use App\Repository\PhotoRepository;
use App\Service\ContactMailService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'contact')]
    public function index(Request $request, PhotoRepository $photoRepository, ContactMailService $contactMailService)
    {
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()) {
            $contactFormData = $form->getData();
            $contactMailService->sendFromContactFormData($contactFormData);
            $this->addFlash('success', 'Votre message a été envoyé');
            return $this->redirectToRoute('contact');
        }

        return $this->render('contact/index.html.twig', [
            'photos' => $photoRepository->findAll(),
            'form' => $form->createView()
        ]);
    }
}
