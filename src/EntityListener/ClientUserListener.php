<?php

namespace App\EntityListener;

use App\Entity\ClientUser;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class ClientUserListener
{
    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    public function prePersist(ClientUser $clientUser)
    {
        $this->encodePassword($clientUser);
    }

    public function preUpdate(ClientUser $clientUser)
    {
        $this->encodePassword($clientUser);
    }

    public function encodePassword(ClientUser $clientUser)
    {
        if ($clientUser->getPlainPassword() === null) {
            return;
        }

        $clientUser->setPassword(
            $this->hasher->hashPassword(
                $clientUser,
                $clientUser->getPlainPassword()
            )
        );
    }
}
