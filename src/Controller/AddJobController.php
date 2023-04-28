<?php

namespace App\Controller;

use App\Form\JobOfferType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\JobOffer;
use App\Entity\Client;
use App\Repository\ClientRepository;
use App\Repository\JobOfferRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class AddJobController extends AbstractController
{
    #[Route('/admin/client/new-job-offer', name: 'app_add_job')]
    public function index(Request $request, EntityManagerInterface $manager): Response
    {
        $addJob = new JobOffer();

        $form = $this->createForm(JobOfferType::class, $addJob);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $addJob = $form->getData();

            $manager->persist($manager);
            $manager->flush();

            $this->addFlash(
                'succes',
                'Votre offre de job a bien été créée'
            );
        } else {
            $this->addFlash(
                'succes',
                'Votre offre de job est invalide'
            );
        }

        return $this->render('admin/addjob.html.twig', [
            'controller_name' => 'AddJobController',
            'form' => $form->createView(),
        ]);
    }

    #[Route('/admin/client/joblist/{id}', name: 'app_joblist')]
    public function joblist(
        ClientRepository $client,
        ?int $id = null
    ): Response {
        $clientName = $client->find($id);
        $jobList = $clientName->getJobOffers();
        return $this->render('admin/joblist.html.twig', [
            'job_list' => $jobList
        ]);
    }
}
