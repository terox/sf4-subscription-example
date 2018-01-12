<?php

namespace App\DataFixtures\ORM;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class LoadUserData extends Fixture
{
    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $names = [
            'Jorge',
            'Ana',
            'Jaime',
            'Pablo',
            'Juana'
        ];

        for($i = 0; $i < 5; $i++) {

            $user = new User();
            $user
                ->setEmail(sprintf('%s@example.com', strtolower($names[$i])));

            $manager->persist($user);
        }

        $manager->flush();
    }
}