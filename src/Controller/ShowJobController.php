<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ShowJobController extends AbstractController
{
    #[Route('/details/job', name: 'app_show_job')]
    public function index(): Response
    {
        return $this->render('user/showjobs.html.twig', [
            'controller_name' => 'ShowJobController',
        ]);
    }
}
