<?php
/*
 * Copyright (c) 2023. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
 * Morbi non lorem porttitor neque feugiat blandit. Ut vitae ipsum eget quam lacinia accumsan.
 * Etiam sed turpis ac ipsum condimentum fringilla. Maecenas magna.
 * Proin dapibus sapien vel ante. Aliquam erat volutpat. Pellentesque sagittis ligula eget metus.
 * Vestibulum commodo. Ut rhoncus gravida arcu.
 */

namespace App\Controller;

use App\Repository\HotelRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AsideAccueilController extends AbstractController
{
    #[Route('/aside', name: 'app_aside_accueil', methods: ['GET'], priority: 3)]
    public function header(HotelRepository $hotelRepository): Response
    {
        $user = $this->getUser();
        return $this->render('/hotel/_aside_hotels.html.twig', [
            'hotels' => $hotelRepository->findAllHotelsAndPics(),
            'user_hotel' => $user,
        ])->setSharedMaxAge(3600);
    }
}