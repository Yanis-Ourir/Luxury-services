<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Candidate;
use App\Entity\User;
use App\Repository\UserRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class ProfilController extends AbstractController
{
    #[Security("is_granted('ROLE_USER') and user === currentUser")]
    #[Route('/profil/{id}', name: 'app_profil', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_USER')]
    public function index(
        Request $request,
        EntityManagerInterface $manager,
        User $currentUser,
        UserRepository $userRepository,
        ?int $id = null
    ): Response {

        $candidate = new Candidate();
        $userId = $userRepository->find($id);

        $gender = $request->request->get('gender');
        $firstName = $request->request->get('first_name');
        $lastName = $request->request->get('last_name');
        $currentLocation = $request->request->get('current_location');
        $address = $request->request->get('address');
        $country = $request->request->get('country');
        $nationality = $request->request->get('nationality');
        $birthDate = $request->request->get('birth_date');
        $birthPlace = $request->request->get('birth_place');
        $profilPicture = $request->request->get('photo');
        $passport = $request->request->get('passport');
        $cv = $request->request->get('cv');
        $jobSector = $request->request->get('job_sector');
        $experience = $request->request->get('experience');
        $availability = $request->request->get('availability');

        if ($firstName != null && $lastName != null) {
            $candidate->setGender($gender);
            $candidate->setFirstName($firstName);
            $candidate->setLastName($lastName);
            $candidate->setCurrentLocation($currentLocation);
            $candidate->setAddress($address);
            $candidate->setCountry($country);
            $candidate->setNationality($nationality);
            $candidate->setDateOfBirth($birthDate);
            $candidate->setPlaceOfBirth($birthPlace);
            $candidate->setIdUser($userId);
            $candidate->setAvailability($availability);
            $candidate->setExperience($experience);
            $candidate->setJobCategory($jobSector);

            if ($profilPicture != null) {
                $candidate->setImageFile();
            } else {
                $candidate->setImageFile(null);
            }

            if ($passport != null) {
                $candidate->setPassportFile($passport);
            } else {
                $candidate->setPassportFile(null);
            }

            if ($cv != null) {
                $candidate->setCv($cv);
            } else {
                $candidate->setCv(null);
            }

            $manager->persist($candidate);
            $manager->flush();
            dd($candidate);

            $this->addFlash(
                'success',
                'Votre profil a été créé avec succès'
            );

            return $this->redirectToRoute('app_profil', ['id' => $currentUser->getId()]);
        } else {
            $this->addFlash(
                'success',
                'Vos informations contiennent des erreurs',
            );
        }

        return $this->render('user/profil.html.twig', [
            'controller_name' => 'ProfilController',
            'user' => $currentUser,
            'user_id' => $userId,

        ]);
    }
}
