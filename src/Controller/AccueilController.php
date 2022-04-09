<?php

namespace App\Controller;

use App\Repository\HotelRepository;
use App\Repository\PhotoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccueilController extends AbstractController
{

    #[Route('/', name: 'app_accueil', methods: ['GET'])]
    public function slide(HotelRepository $hotelRepository, PhotoRepository $photoRepository): Response
    {
        return $this->render('accueil/index.html.twig', [
            'hotels' => $hotelRepository->findAll(),
            'photos' => $photoRepository->findAll(),
        ]);
    }
    
}
