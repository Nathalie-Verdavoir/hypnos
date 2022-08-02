<?php

namespace App\Controller;

use App\Entity\Photo;
use App\Entity\Chambres;
use App\Form\PhotoChambreType;
use App\Repository\ChambresRepository;
use App\Repository\PhotoRepository;
use App\Service\ImageUploader;
use App\Service\ManageImage;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Security("is_granted('ROLE_GERANT')", statusCode: 404)]
#[Route('/photo-chambre/{chambre}')]
class PhotoChambreController extends AbstractController
{
    #[Route('/index', name: 'app_photo_chambre_index', methods: ['GET'])]
    public function index($chambre, PhotoRepository $photoRepository, ChambresRepository $chambresRepository): Response
    {
        if ($chambresRepository->find($chambre)->getHotel()->getGerant() !== $this->getUser()) {
            throw $this->createAccessDeniedException();
        }
        return $this->render('photo-chambre/index.html.twig', [
            'photos' => $photoRepository->findByChambre($chambre),
        ]);
    }

    #[Route('/new', name: 'app_photo_chambre_new', methods: ['GET', 'POST'])]
    public function new(Request $request, PhotoRepository $photoRepository, $chambre, ChambresRepository $chambresRepository, ManageImage $manageImage): Response
    {
        if ($chambresRepository->find($chambre)->getHotel()->getGerant() !== $this->getUser()) {
            throw $this->createAccessDeniedException();
        }
        $photos = [];
        $form = $this->createForm(PhotoChambreType::class, $photos);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $attachments = $form['images']->getData();
            if ($attachments) {
                foreach ($attachments as $uploadedFile) {
                    $photo = new Photo();
                    $imageLink = $manageImage->upload($uploadedFile);
                    /** @var Chambres $chambres */
                    $chambres = $chambresRepository->find($chambre);
                    $photo->setChambres($chambres)
                        ->setCover(false)
                        ->setLien($imageLink);
                    $photoRepository->add($photo);
                    $this->addFlash('success', 'Votre image a été enregistrée');
                }
            }
            return $this->redirectToRoute('app_photo_chambre_index', [
                'chambre' => $chambre,
            ], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('photo-chambre/new.html.twig', [
            'photo' => $photos,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_photo_chambre_show', methods: ['GET'])]
    public function show(Photo $photo, $chambre, ChambresRepository $chambresRepository): Response
    {
        if ($chambresRepository->find($chambre)->getHotel()->getGerant() !== $this->getUser()) {
            throw $this->createAccessDeniedException();
        }
        return $this->render('photo-chambre/show.html.twig', [
            'photo' => $photo,
        ]);
    }

    #[Route('/edit/{cover}', name: 'app_photo_chambre_edit', methods: ['GET', 'POST'])]
    public function edit(PhotoRepository $photoRepository, $cover, $chambre, ChambresRepository $chambresRepository): Response
    {
        if ($chambresRepository->find($chambre)->getHotel()->getGerant() !== $this->getUser()) {
            throw $this->createAccessDeniedException();
        }
        $photoOfThisChambre = $photoRepository->findByChambre($chambre);
        foreach ($photoOfThisChambre as $photo) {
            if (intval($cover) === $photo->getId()) {
                $photo->setCover(true);
            } else {
                $photo->setCover(false);
            }
            $photoRepository->add($photo);
        }

        return $this->redirectToRoute('app_photo_chambre_index', [
            'chambre' => $chambre,
        ], Response::HTTP_SEE_OTHER);
    }

    #[Route('/{id}', name: 'app_photo_chambre_delete', methods: ['POST'])]
    public function delete(Request $request, Photo $photo, PhotoRepository $photoRepository, $chambre, ChambresRepository $chambresRepository): Response
    {
        if ($chambresRepository->find($chambre)->getHotel()->getGerant() !== $this->getUser()) {
            throw $this->createAccessDeniedException();
        }
        if ($this->isCsrfTokenValid('delete' . $photo->getId(), $request->request->get('_token'))) {
            $path = $photo->getLien();
            $result = (new ImageUploader())->remove(substr($path, 0,  strrpos($path, ".")));
            if ($result['result'] == 'ok') {
                $this->addFlash('success', 'Votre image a été supprimée' . ' (' . substr($path, 0,  strrpos($path, ".")) . ')');
                $photoRepository->remove($photo);
            }
        }

        return $this->redirectToRoute('app_photo_chambre_index', [
            'photo' => $photo,
            'chambre' => $chambre,
        ], Response::HTTP_SEE_OTHER);
    }
}
