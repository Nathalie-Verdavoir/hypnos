<?php

namespace App\Controller;

use App\Entity\Reservation;
use App\Entity\User;
use App\Form\ReservationType;
use App\Repository\ReservationRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/reservation')]
class ReservationController extends AbstractController
{
    #[Security("is_granted('ROLE_GERANT')", statusCode: 403)]
    #[Route('/', name: 'app_reservation_index', methods: ['GET'])]
    public function index(ReservationRepository $reservationRepository): Response
    {
        /** @var User $user */
        $user = $this->getUser();
        /** @var Hotel $hotel */
        $hotel = $user->getHotel();
        $reservations = [];
        foreach( $hotel->getChambres() as $chambres) {
            $reservations = [...$reservations, ...$reservationRepository->findByChambre($chambres)];
        }
        return $this->render('reservation/index.html.twig', [
            'reservations' => $reservations,
        ]);
    }

    #[Security("is_granted('ROLE_CLIENT')", statusCode: 403)]
    #[Route('/client/{client}', name: 'app_reservation_client_index', methods: ['GET'])]
    public function indexClient(ReservationRepository $reservationRepository, User $client): Response
    {
        if ($client !== $this->getUser()) {
            throw $this->createAccessDeniedException();
        }
        return $this->render('reservation/index_client.html.twig', [
            'reservations' => $reservationRepository->findAllByClient($client),
        ]);
    }
    
    #[Security("is_granted('ROLE_CLIENT')", statusCode: 403)]
    #[Route('/new/{chambre}', name: 'app_reservation_new_chambre', methods: ['GET', 'POST'])]
    public function newResa(Request $request, ReservationRepository $reservationRepository): Response
    {
        $reservation = new Reservation();
        $form = $this->createForm(ReservationType::class, $reservation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
             
            $reservationRepository->add($reservation);
            return $this->redirectToRoute('app_reservation_client_index', [
                'client' => $this->getUser(),
            ], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('reservation/new.html.twig', [
            'reservation' => $reservation,
            'form' => $form,
        ]);
    }

    #[Security("is_granted('ROLE_GERANT')", statusCode: 403)]
    #[Route('/{id}', name: 'app_reservation_show', methods: ['GET'])]
    public function show(Reservation $reservation): Response
    {
        if ($reservation->getChambre()->getHotel()->getGerant() !== $this->getUser()) {
            throw $this->createAccessDeniedException();
        }
        return $this->render('reservation/show.html.twig', [
            'reservation' => $reservation,
        ]);
    }

    #[Security("is_granted('ROLE_GERANT')", statusCode: 403)]
    #[Route('/{id}/edit', name: 'app_reservation_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Reservation $reservation, ReservationRepository $reservationRepository): Response
    {
        if ($reservation->getChambre()->getHotel()->getGerant() !== $this->getUser()) {
            throw $this->createAccessDeniedException();
        }
        $form = $this->createForm(ReservationType::class, $reservation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $reservationRepository->add($reservation);
            return $this->redirectToRoute('app_reservation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('reservation/edit.html.twig', [
            'reservation' => $reservation,
            'form' => $form,
        ]);
    }

    #[Security("is_granted('ROLE_CLIENT')", statusCode: 403)]
    #[Route('/{id}', name: 'app_reservation_delete', methods: ['POST'])]
    public function delete(Request $request, Reservation $reservation, ReservationRepository $reservationRepository): Response
    {
        /** @var User $user */
        $user = $this->getUser();
        if ($reservation->getClient() !== $user) {
            throw $this->createAccessDeniedException();
        }
        if ($this->isCsrfTokenValid('delete'.$reservation->getId(), $request->request->get('_token'))) {
            $reservationRepository->remove($reservation);
        }

        if (in_array( 'ROLE_CLIENT' , $user->getRoles() )) {
            return $this->redirectToRoute('app_reservation_client_index', [
                'client' => $user->getId(),
            ], Response::HTTP_SEE_OTHER);
        }
        return $this->redirectToRoute('app_reservation_index', [], Response::HTTP_SEE_OTHER);
    }
}
