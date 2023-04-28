<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\User;

class SignController extends AbstractController
{
    #[Route('/sign', name: 'app_sign', methods: ['GET', 'POST'])]
    public function index(Request $request, EntityManagerInterface $manager): Response
    {

        $user = new User();
        $email = $request->request->get('email');
        $password = $request->request->get('password');
        $passwordConfirmation = $request->request->get('password_confirmation');


        if ($password === $passwordConfirmation && $email != null && $password != null) {
            $user->setEmail($email);
            $user->setPassword($password);
            $user->setPlainPassword($password);
            $user->setRoles(["ROLE_USER"]);
            $manager->persist($user);
            $manager->flush();

            $this->addFlash(
                'error',
                'Votre compte a bien été créée',
            );

            return $this->redirectToRoute('app_profil', ['id' => $user->getId()]);
        } else {
            $this->addFlash(
                'error',
                'Certaines informations sont invalides',
            );
        }

        return $this->render('user/sign.html.twig', [
            'controller_name' => 'SignController',
        ]);
    }
}
