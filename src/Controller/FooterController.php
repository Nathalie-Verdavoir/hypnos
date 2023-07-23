<?php
/*
 * Copyright (c) 2023. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
 * Morbi non lorem porttitor neque feugiat blandit. Ut vitae ipsum eget quam lacinia accumsan.
 * Etiam sed turpis ac ipsum condimentum fringilla. Maecenas magna.
 * Proin dapibus sapien vel ante. Aliquam erat volutpat. Pellentesque sagittis ligula eget metus.
 * Vestibulum commodo. Ut rhoncus gravida arcu.
 */

namespace App\Controller;

use App\Controller\ModelManagerController\ModelManagerController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

//use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FooterController extends ModelManagerController
{
    #[Route('/footer', name: 'app_footer', methods: ['GET'], priority: 3)]
    public function footer(): Response
    {

        return $this->render('footer.html.twig');
    }
}