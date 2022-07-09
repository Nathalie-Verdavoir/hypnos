<?php

namespace App\Controller;

use App\Entity\Chambres;
use App\Entity\Hotel;
use App\Entity\Reservation;
use App\Form\ChambresType;
use App\Form\ReservationType;
use App\Repository\ChambresRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/chambres')]
class ChambresController extends AbstractController
{
    #[Security("is_granted('ROLE_GERANT')", statusCode: 403)]
    #[Route('/', name: 'app_chambres_index', methods: ['GET'])]
    public function index(ChambresRepository $chambresRepository): Response
    {
        return $this->render('chambres/index.html.twig', [
            'chambres' => $chambresRepository->findAll(),
        ]);
    }

    #[Security("is_granted('ROLE_GERANT')", statusCode: 403)]
    #[Route('/new', name: 'app_chambres_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ChambresRepository $chambresRepository): Response
    {
        $chambre = new Chambres();
        $form = $this->createForm(ChambresType::class, $chambre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var User $gerant */
            $gerant = $this->getUser();
            /** @var Hotel $hotel */
            $hotel = $gerant->getHotel();
            $chambre->setHotel($hotel);
            $chambresRepository->add($chambre);
            return $this->redirectToRoute('app_chambres_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('chambres/new.html.twig', [
            'chambre' => $chambre,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_chambres_show', methods: ['GET', 'POST'])]
    public function show(Request $request, Chambres $chambre, EntityManagerInterface $entityManager, $id): Response
    {
        $reservation = new Reservation();
        $form = $this->createForm(ReservationType::class, $reservation);
        $form->handleRequest($request);
        $reservation->setClient($this->getUser());
        if ($form->isSubmitted() && $form->isValid()) { 
            /** @var User $user */
            $user = $this->getUser();
            if($user==null || !in_array('ROLE_USER', $user->getRoles()) ){
                return $this->redirectToRoute('login', [ 
                    'to' => 'app_hotel_show',
                    'id' => $id,
                    'resa_debut' => $reservation->getDebut()->getTimestamp(),
                    'resa_chambre' => $reservation->getChambre()->getId(),
                    
                    'resa_fin' => $reservation->getFin()->getTimestamp(),
                ], Response::HTTP_SEE_OTHER);
            }
            
            $entityManager->persist($reservation);
            $entityManager->flush();
            return $this->redirectToRoute('app_reservation_client_index', [
                'client' => $user->getId(),
            ], Response::HTTP_SEE_OTHER);
        }
        
        
        return $this->render('chambres/show.html.twig', [
            'chambre' => $chambre,
            'id' => $id,
            'form' => $form->createView(),
        ]);
    }
    
    #[Security("is_granted('ROLE_GERANT')", statusCode: 403)]
    #[Route('/{id}/edit', name: 'app_chambres_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Chambres $chambre, ChambresRepository $chambresRepository): Response
    {
        $form = $this->createForm(ChambresType::class, $chambre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $chambresRepository->add($chambre);
            return $this->redirectToRoute('app_chambres_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('chambres/edit.html.twig', [
            'chambre' => $chambre,
            'form' => $form,
        ]);
    }

    #[Security("is_granted('ROLE_GERANT')", statusCode: 403)]
    #[Route('/{id}', name: 'app_chambres_delete', methods: ['POST'])]
    public function delete(Request $request, Chambres $chambre, ChambresRepository $chambresRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$chambre->getId(), $request->request->get('_token'))) {
            $chambresRepository->remove($chambre);
        }

        return $this->redirectToRoute('app_chambres_index', [], Response::HTTP_SEE_OTHER);
    }
}
