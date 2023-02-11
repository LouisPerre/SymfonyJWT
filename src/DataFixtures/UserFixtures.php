<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    public function __construct(private UserPasswordHasherInterface $hasher)
    {
    }

    public function load(ObjectManager $manager): void
    {
        $userAdmin = new User();
        $userAdmin->setEmail('admin@admin.com');
        $password = $this->hasher->hashPassword($userAdmin, 'admin');
        $userAdmin->setPassword($password);
        $userAdmin->setRoles([
            'ROLE_ADMIN',
            'ROLE_USER'
        ]);
        $manager->persist($userAdmin);
        $manager->flush();

        $user = new User();
        $user->setEmail('user@user.com');
        $password = $this->hasher->hashPassword($user, 'user');
        $user->setPassword($password);
        $user->setRoles([
            'ROLE_USER'
        ]);
        $manager->persist($user);
        $manager->flush();
    }
}
