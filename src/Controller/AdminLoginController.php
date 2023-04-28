<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminLoginController extends AbstractController
{
    #[Route('/admin/login', name: 'app_admin_login', methods: ['GET', 'POST'])]
    public function loginAdmin(): Response
    {
        return $this->render('admin/admin_login.html.twig', [
            'controller_name' => 'AdminLoginController',
        ]);
    }
}
