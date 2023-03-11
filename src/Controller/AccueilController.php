<?php

namespace App\Controller;

use App\Controller\ModelManagerController\ModelManagerController;
use App\Repository\HotelRepository;
use App\Repository\PhotoRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccueilController extends ModelManagerController
{

    #[Route('/', name: 'app_accueil', methods: ['GET'])]
    public function slide(HotelRepository $hotelRepository, PhotoRepository $photoRepository): Response
    {
        $t=3;
        return $this->render('accueil/index.html.twig', [
            'hotels' => $hotelRepository->findAll(),
            'photos' => $photoRepository->findAll(),
        ]);
    }
}
