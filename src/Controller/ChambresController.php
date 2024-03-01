<?php

namespace App\Controller;

use App\Controller\ModelManagerController\ModelManagerController;
use App\Entity\Chambres;
use App\Entity\Hotel;
use App\Entity\Reservation;
use App\Entity\User;
use App\Form\ChambresType;
use App\Form\ReservationType;
use App\Repository\ChambresRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\ExpressionLanguage\Expression;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\Workflow\Registry;

#[Route('/chambres')]
class ChambresController extends ModelManagerController
{
    #[IsGranted(new Expression('is_granted("ROLE_ADMIN") or is_granted("ROLE_GERANT")'))]
    #[Route('/', name: 'app_chambres_index', methods: ['GET'], priority: 2)]
    public function index(ChambresRepository $chambresRepository): Response
    {
        return $this->render('chambres/index.html.twig', [
            'chambres' => $chambresRepository->findAll(),
        ]);
    }

    #[IsGranted('create', 'chambres', '', 403)]
    #[Route('/new', name: 'app_chambres_new', methods: ['GET', 'POST'], priority: 2)]
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

    #[Route('/{id}', name: 'app_chambres_show', methods: ['GET', 'POST'], priority: 2)]
    public function show(Request $request, Chambres $chambre, EntityManagerInterface $entityManager, $id): Response
    {
        $reservation = new Reservation();
        $form = $this->createForm(ReservationType::class, $reservation);
        $form->handleRequest($request);
        $reservation->setClient($this->getUser());
        if ($form->isSubmitted() && $form->isValid()) {
            /** @var User $user */
            $user = $this->getUser();
            if ($user == null || !in_array('ROLE_USER', $user->getRoles())) {
                return $this->redirectToRoute('login', [
                    'to' => 'app_chambres_show',
                    'id' => $id,
                    'isChambreResa' => true,
                    'resa_debut' => $reservation->getDebut()->getTimestamp(),
                    'resa_chambre' => $reservation->getChambre()->getId(),
                    'resa_fin' => $reservation->getFin()->getTimestamp(),
                ], Response::HTTP_SEE_OTHER);
            }

            $this->modelManagerAdapter->save($reservation, 'Reservations');

            return $this->redirectToRoute('app_reservation_client_index', [
                'client' => $user->getId(),
            ], Response::HTTP_SEE_OTHER);
        }


        return $this->render('chambres/show.html.twig', [
            'chambre' => $chambre,
            'isChambreResa' => true,
            'id' => $id,
            'form' => $form->createView(),
        ]);
    }

    #[IsGranted('edit', 'chambres', '', 403)]
    #[Route('/{id}/edit', name: 'app_chambres_edit', methods: ['GET', 'POST'], priority: 2)]
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

    #[IsGranted('edit', 'chambres', '', 403)]
    #[Route('/{id}', name: 'app_chambres_delete', methods: ['POST'], priority: 2)]
    public function delete(Request $request, Chambres $chambre, ChambresRepository $chambresRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $chambre->getId(), $request->request->get('_token'))) {
            $chambresRepository->remove($chambre);
        }

        return $this->redirectToRoute('app_chambres_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/clean/{id}', name: 'app_chambres_clean', methods: ['POST'], priority: 2)]
    public function clean(Request $request, Chambres $chambre, ChambresRepository $chambresRepository, Registry $workflows): Response
    {
        if ($this->isCsrfTokenValid('clean' . $chambre->getId(), $request->request->get('_token'))) {
            $workflow = $workflows->get($chambre);
            if ($chambre->getCleaningState() === null || $chambre->getCleaningState() === 'clean') {
                if ($workflow->can($chambre, 'to_dirty')) {
                    $workflow->apply($chambre, 'to_dirty');
                    $chambresRepository->add($chambre);
                }
            } else {
                if ($workflow->can($chambre, 'to_clean')) {
                    $workflow->apply($chambre, 'to_clean');
                    $chambresRepository->add($chambre);
                }
            }
        }

        return $this->redirectToRoute('app_chambres_index', [], Response::HTTP_SEE_OTHER);
    }
}
