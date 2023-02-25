<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
// use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class AdminFixtures extends Fixture
{
    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager)
    {
        $admin = new User();
        $admin->setFirstname('Admin');
        $admin->setLastname('Administrator');
        $admin->setEmail('admin@example.com');
        $admin->setPhoneNumber(0615151515);
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setIsBlocked(false);
        $admin->setPassword($this->passwordHasher->hashPassword(
            $admin,
            'EyesContact331@'
        ));

        $manager->persist($admin);
        $manager->flush();
    }
}
