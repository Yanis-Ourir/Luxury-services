<?php

namespace App\Controller;

use App\Repository\JobOfferRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class AdminController extends AbstractController
{
    #[Route('/admin', name: 'app_admin')]
    public function new(UserRepository $users): Response
    {

        return $this->render('admin/manager.html.twig', [
            'controller_name' => 'AdminController',

        ]);
    }

    #[Route('/admin/manager/user', name: 'app_admin')]
    public function manager(UserRepository $users): Response
    {
        $userList = $users->findAll();

        return $this->render('admin/manager.html.twig', [
            'controller_name' => 'AdminController',
            'users' => $userList
        ]);
    }

    #[Route('/admin/manager/joboffer', name: 'app_job_manager')]
    public function job(JobOfferRepository $jobs): Response
    {
        $jobList = $jobs->findAll();
        return $this->render('admin/jobmanager.html.twig', [
            'controller_name' => 'AdminController',
            'jobs' => $jobList
        ]);
    }
}
