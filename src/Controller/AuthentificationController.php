<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AuthentificationController extends AbstractController
{
    #[Route('/authentification', name: 'app_authentification', methods: ['GET', 'POST'])]
    public function login(): Response
    {
        return $this->render('user/authentification.html.twig', [
            'controller_name' => 'AuthentificationController',
        ]);
    }

    #[Route('/deconnexion', name: 'app_deconnexion')]
    public function logout()
    {
        // Ne rien faire ici
    }
}
