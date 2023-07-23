<?php

namespace App\Controller;

use App\Controller\ModelManagerController\ModelManagerController;
use App\Entity\Hotel;
use App\Entity\Photo;
use App\Entity\User;
use App\Form\PhotoHotelType;
use App\Repository\PhotoRepository;
use App\Service\ImageUploader;
use App\Service\ManageImage;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted(['ROLE_GERANT'], statusCode: 403)]
#[Route('/photo-hotel/{hotel}')]
class PhotoHotelController extends ModelManagerController
{
    #[Route('/', name: 'app_photo_index', methods: ['GET'])]
    public function index(Hotel $hotel, PhotoRepository $photoRepository): Response
    {
        if ($hotel->getGerant() !== $this->getUser()) {
            throw $this->createAccessDeniedException();
        }
        return $this->render('photo-hotel/index.html.twig', [
            'photos' => $photoRepository->findByHotel($hotel),
        ]);
    }

    #[Route('/new', name: 'app_photo_new', methods: ['GET', 'POST'])]
    public function new(Hotel $hotel, Request $request, PhotoRepository $photoRepository, ManageImage $manageImage): Response
    {
        if ($hotel->getGerant() !== $this->getUser()) {
            throw $this->createAccessDeniedException();
        }
        $photos = [];
        $form = $this->createForm(PhotoHotelType::class, $photos);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $attachments = $form['images']->getData();
            if ($attachments) {
                foreach ($attachments as $uploadedFile) {
                    $photo = new Photo();
                    $imageLink = $manageImage->upload($uploadedFile);
                    /** @var User $gerant */
                    $gerant = $this->getUser();
                    /** @var Hotel $hotel */
                    $hotel = $gerant->getHotel();
                    $photo->setHotel($hotel)
                        ->setCover(false)
                        ->setLien($imageLink);
                    $photoRepository->add($photo);
                    $this->addFlash('success', 'Votre image a été enregistrée');
                }
            }
            return $this->redirectToRoute('app_photo_index', [
                'hotel' => $photo->getHotel()->getId(),
            ], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('photo-hotel/new.html.twig', [
            'photo' => $photos,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_photo_show', methods: ['GET'])]
    public function show(Hotel $hotel, Photo $photo): Response
    {
        if ($hotel->getGerant() !== $this->getUser()) {
            throw $this->createAccessDeniedException();
        }
        return $this->render('photo-hotel/show.html.twig', [
            'photo' => $photo,
        ]);
    }

    #[Route('/{id}/edit/{cover}', name: 'app_photo_edit', methods: ['GET', 'POST'])]
    public function edit(Hotel $hotel, Hotel $id, PhotoRepository $photoRepository, $cover): Response
    {
        if ($hotel->getGerant() !== $this->getUser()) {
            throw $this->createAccessDeniedException();
        }

        $photoOfThisHotel = $photoRepository->findByHotel($id);
        foreach ($photoOfThisHotel as $photo) {
            if (intval($cover) === $photo->getId()) {
                $photo->setCover(true);
            } else {
                $photo->setCover(false);
            }
            $photoRepository->add($photo);
        }

        return $this->render('photo-hotel/index.html.twig', [
            'photos' => $photoRepository->findPhotosAndHotelsAndChambres(),
        ]);
    }

    #[Route('/{id}', name: 'app_photo_delete', methods: ['POST'])]
    public function delete(Hotel $hotel, Request $request, Photo $photo, PhotoRepository $photoRepository): Response
    {
        if ($hotel->getGerant() !== $this->getUser()) {
            throw $this->createAccessDeniedException();
        }
        if ($this->isCsrfTokenValid('delete' . $photo->getId(), $request->request->get('_token'))) {
            $path = $photo->getLien();
            $result = (new ImageUploader())->remove(substr($path, 0, strrpos($path, ".")));
            if ($result['result'] == 'ok') {
                $this->addFlash('success', 'Votre image a été supprimée' . ' (' . substr($path, 0, strrpos($path, ".")) . ')');
                $photoRepository->remove($photo);
            }
        }

        return $this->redirectToRoute('app_photo_index', [
            'hotel' => $photo->getHotel()->getId(),
        ], Response::HTTP_SEE_OTHER);
    }
}
