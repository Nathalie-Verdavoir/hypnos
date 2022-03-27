<?php

namespace App\Controller;

use App\Entity\Photo;
use App\Entity\Hotel;
use App\Form\PhotoHotelType;
use App\Repository\PhotoRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Gedmo\Sluggable\Util\Urlizer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/photo-hotel')]
class PhotoHotelController extends AbstractController
{
    #[Route('/', name: 'app_photo_index', methods: ['GET'])]
    public function index(PhotoRepository $photoRepository): Response
    {
        return $this->render('photo-hotel/index.html.twig', [
            'photos' => $photoRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_photo_new', methods: ['GET', 'POST'])]
    public function new(Request $request, PhotoRepository $photoRepository): Response
    {
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
    public function show(Photo $photo): Response
    {
        return $this->render('photo-hotel/show.html.twig', [
            'photo' => $photo,
        ]);
    }

    #[Route('/{id}/edit/{cover}', name: 'app_photo_edit', methods: ['GET', 'POST'])]
    public function edit(Hotel $id, Photo $photo, PhotoRepository $photoRepository, $cover): Response
    {
        
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
    public function delete(Request $request, Photo $photo, PhotoRepository $photoRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$photo->getId(), $request->request->get('_token'))) {
            $photoRepository->remove($photo);
        }

        return $this->redirectToRoute('app_photo_index', [], Response::HTTP_SEE_OTHER);
    }
}
