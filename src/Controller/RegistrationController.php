<?php

namespace App\Controller;

use App\Controller\ModelManagerController\ModelManagerController;
use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Repository\PhotoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class RegistrationController extends ModelManagerController
{
    #[Route('/register', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager, PhotoRepository $photoRepository): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);
        $user->setIsActive();

        if ($form->isSubmitted() && $form->isValid()) {

            // encode the plain password
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $user->setRoles(["ROLE_CLIENT"]);
            $this->modelManagerAdapter->save($user, 'Utilisateur');

            //   return $this->redirectToRoute('app_accueil');
        }

        return $this->render('registration/register.html.twig', [
            'photos' => $photoRepository->findAll(),
            'registrationForm' => $form->createView(),
        ]);
    }

    #[Security("is_granted( 'ROLE_ADMIN')", statusCode: 403)]
    #[Route('/register_gerant', name: 'app_register_gerant')]
    public function registerG(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);
        $user->setIsActive();

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );
            $user->setRoles(["ROLE_GERANT"]);
            $this->modelManagerAdapter->save($user, 'Gérant');

            return $this->redirectToRoute('app_accueil');
        }

        return $this->render('registration/register_gerant.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}
