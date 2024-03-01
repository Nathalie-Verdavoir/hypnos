<?php

namespace App\Controller;

use App\Controller\ModelManagerController\ModelManagerController;
use App\Entity\Hotel;
use App\Entity\Reservation;
use App\Entity\User;
use App\Form\HotelType;
use App\Form\ReservationType;
use App\Repository\HotelRepository;
use Symfony\Component\ExpressionLanguage\Expression;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/hotel')]
class HotelController extends ModelManagerController
{
    #[Route('/', name: 'app_hotel_index', methods: ['GET'], priority: 2)]
    #[IsGranted(new Expression('is_granted("ROLE_ADMIN") or is_granted("ROLE_GERANT")'))]
    public function index(HotelRepository $hotelRepository): Response
    {
        return $this->render('hotel/index.html.twig', [
            'hotels' => $hotelRepository->findAllHotelsAndPics(),
        ]);
    }


    #[Route('/new', name: 'app_hotel_new', methods: ['GET', 'POST'], priority: 2)]
    #[IsGranted('create', 'hotel', '', 403)]
    public function new(Request $request, HotelRepository $hotelRepository): Response
    {
        $hotel = new Hotel();
        $form = $this->createForm(HotelType::class, $hotel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $hotelRepository->add($hotel);
            return $this->redirectToRoute('app_hotel_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('hotel/new.html.twig', [
            'hotel' => $hotel,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'app_hotel_show', methods: ['GET', 'POST'], priority: 2)]
    #[IsGranted('view', 'hotel', '', 403)]
    public function show(Request $request, Hotel $hotel, HotelRepository $hotelRepository, $id): Response
    {
        $hotel = $hotelRepository->findHotelAndPics($hotel);
        $reservation = new Reservation();
        $form = $this->createForm(ReservationType::class, $reservation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var User $user */
            $user = $this->getUser();
            if ($user == null || !in_array('ROLE_USER', $user->getRoles())) {
                return $this->redirectToRoute('login', [
                    'to' => 'app_hotel_show',
                    'id' => $id,
                    'resa_debut' => $reservation->getDebut()->getTimestamp(),
                    'resa_chambre' => $reservation->getChambre()->getId(),
                    'resa_fin' => $reservation->getFin()->getTimestamp(),
                ], Response::HTTP_SEE_OTHER);
            }
            $reservation->setClient($this->getUser());
            $this->modelManagerAdapter->save($reservation, 'Reservation');

            return $this->redirectToRoute('app_reservation_client_index', [
                'client' => $user->getId(),
            ], Response::HTTP_SEE_OTHER);
        }

        return $this->render('hotel/show.html.twig', [
            'hotel' => $hotel,
            'form' => $form->createView(),
        ]);
    }

    //  #[Security("is_granted('ROLE_ADMIN') or is_granted('ROLE_GERANT')", statusCode: 403)]
    #[Route('/{id}/edit', name: 'app_hotel_edit', methods: ['GET', 'POST'], priority: 2)]
    #[IsGranted('edit', 'hotel', '', 403)]
    public function edit(Request $request, Hotel $hotel, HotelRepository $hotelRepository): Response
    {
        $form = $this->createForm(HotelType::class, $hotel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $hotelRepository->add($hotel);
            return $this->redirectToRoute('app_hotel_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('hotel/edit.html.twig', [
            'hotel' => $hotel,
            'form' => $form,
        ]);
    }


    #[Route('/{id}', name: 'app_hotel_delete', methods: ['POST'], priority: 2)]
    #[IsGranted('edit', 'hotel', '', 403)]
    public function delete(Request $request, Hotel $hotel, HotelRepository $hotelRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $hotel->getId(), $request->request->get('_token'))) {
            $hotelRepository->remove($hotel);
        }

        return $this->redirectToRoute('app_hotel_index', [], Response::HTTP_SEE_OTHER);
    }
}
