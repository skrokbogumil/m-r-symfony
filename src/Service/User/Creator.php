<?php

namespace App\Service\User;

use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\User;

class Creator
{
    private EntityManagerInterface $entityManager;
    private UserPasswordEncoderInterface $passwordEncoder;

    public function __construct(EntityManagerInterface $entityManager, UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->entityManager = $entityManager;
        $this->passwordEncoder = $passwordEncoder;
    }

    public function create(User $user)
    {
        $this->updatePassword($user);
        $user->setEnabled(true);

        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }

    private function updatePassword(User $user)
    {
        $user->setPassword(
            $this->passwordEncoder->encodePassword(
                $user,
                $user->getPlainPassword()
            )
        );
        $user->eraseCredentials();
    }

}
