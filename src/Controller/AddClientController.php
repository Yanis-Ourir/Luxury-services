<?php

namespace App\Controller;

use App\Entity\Client;
use App\Entity\ClientUser;
use App\Form\ClientType;
use App\Form\ClientUserType;
use App\Repository\ClientUserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\SecurityUserInterface;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\Security\Core\User\UserInterface;

class AddClientController extends AbstractController
{
    #[Route('/admin/client', name: 'app_add_client')]
    public function new(Request $request, EntityManagerInterface $manager): Response
    {
        $client = new ClientUser();
        $form = $this->createForm(ClientUserType::class, $client);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $client = $form->getData();
            $client->setRoles(['ROLE_CLIENT']);
            $password = $client->getPassword();
            $client->setPlainPassword($password);
            $manager->persist($client);
            $manager->flush();

            return $this->redirectToRoute('app_home');
        } else {
            $this->addFlash(
                'success',
                'Votre compte client est invalide'
            );
        }

        return $this->render('admin/addclient.html.twig', [
            'controller_name' => 'AddClientController',
            'form' => $form->createView()
        ]);
    }

    #[Route('/admin/client/details/{id}', name: 'app_client_details', methods: ['GET', 'POST'])]
    public function update(
        Request $request,
        EntityManagerInterface $manager,
        ClientUserRepository $clientUserRepository,
        ?int $id = null
    ): Response {
        $client = new Client();
        $clientId = $clientUserRepository->find($id);
        $form = $this->createForm(ClientType::class, $client);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $client = $form->getData();
            $client->setUserClient($clientId);
            $manager->persist($client);
            $manager->flush();

            $this->addFlash(
                'success',
                'Votre compte client est valide'
            );
        } else {
            $this->addFlash(
                "success",
                "Votre compte client n'est pas valide",
            );
        }
        return $this->render('admin/client_details.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
