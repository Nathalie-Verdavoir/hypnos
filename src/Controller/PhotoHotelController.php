<?php

namespace App\Controller;

use App\Entity\Photo;
use App\Entity\Hotel;
use App\Form\PhotoHotelType;
use App\Repository\PhotoRepository;
use Gedmo\Sluggable\Util\Urlizer;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Security("is_granted('ROLE_GERANT')", statusCode: 404)]
#[Route('/photo-hotel/{hotel}')]
class PhotoHotelController extends AbstractController
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
    public function new(Hotel $hotel, Request $request, PhotoRepository $photoRepository): Response
    {
        if ($hotel->getGerant() !== $this->getUser()) {
            throw $this->createAccessDeniedException();
        }
        $photos= [];
        $form = $this->createForm(PhotoHotelType::class, $photos);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $attachments = $form['images']->getData();
            if ($attachments) {
                foreach($attachments as $uploadedFile)
                {
                    $photo = new Photo();
                    /** @var UploadedFile $uploadedFile */
                    $destination = $this->getParameter('kernel.project_dir').'/public/uploads/photos';
                    $originalFilename = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
                    $newFilename = Urlizer::urlize($originalFilename).'-'.uniqid().'.'.$uploadedFile->guessExtension();
                    $uploadedFile->move(
                        $destination,
                        $newFilename,
                        0777
                    );
                    /** @var User $gerant */
                    $gerant = $this->getUser();
                    /** @var Hotel $hotel */
                    $hotel = $gerant->getHotel();
                    $photo->setHotel($hotel);
                    $photo->setCover(false);
                    $photo->setLien($newFilename);
                    $photoRepository->add($photo);
                }
            }
            return $this->redirectToRoute('app_photo_index', [], Response::HTTP_SEE_OTHER);
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
            foreach($photoOfThisHotel as $photo)
            {
                if(intval($cover) === $photo->getId())
                {
                    $photo->setCover(true);
                }else {
                    $photo->setCover(false);
                }
                $photoRepository->add($photo);
                
            }
            
        return $this->render('photo-hotel/index.html.twig', [
            'photos' => $photoRepository->findAll(),
        ]);
    }

    #[Route('/{id}', name: 'app_photo_delete', methods: ['POST'])]
    public function delete(Hotel $hotel, Request $request, Photo $photo, PhotoRepository $photoRepository): Response
    {
        if ($hotel->getGerant() !== $this->getUser()) {
            throw $this->createAccessDeniedException();
        }
        if ($this->isCsrfTokenValid('delete'.$photo->getId(), $request->request->get('_token'))) {
            $folder = $this->getParameter('kernel.project_dir').'/public/uploads/photos/';
            $path = $folder . $photo->getLien();
            $filesystem = new Filesystem();
            $filesystem->remove($path);

            $photoRepository->remove($photo);
        }

        return $this->redirectToRoute('app_photo_index', [], Response::HTTP_SEE_OTHER);
    }
}
