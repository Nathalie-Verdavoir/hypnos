<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/legals')]
class MentionsLegalesController extends AbstractController
{

    #[Route('/mentions', name: 'app_mentions', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('legals/mentions.html.twig');
    }

    #[Route('/cgu', name: 'app_cgu', methods: ['GET'])]
    public function indexCGU(): Response
    {
        return $this->render('legals/cgu.html.twig');
    }


    
}
