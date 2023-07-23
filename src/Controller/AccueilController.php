<?php

namespace App\Controller;

use App\Controller\ModelManagerController\ModelManagerController;
use App\Repository\HotelRepository;
use App\Repository\PhotoRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccueilController extends ModelManagerController
{

    #[Route('/', name: 'app_accueil', methods: ['GET'], priority: 2)]
    public function slide(HotelRepository $hotelRepository, PhotoRepository $photoRepository): Response
    {

        return $this->render('accueil/index.html.twig', [
            'hotels' => $hotelRepository->findAllHotelsAndPics(),
            'photos' => $photoRepository->findPhotosAndHotelsAndChambres(),
        ]);
    }
}
