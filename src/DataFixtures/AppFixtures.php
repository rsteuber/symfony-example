<?php

namespace App\DataFixtures;

use App\Infrastructure\Persistence\Doctrine\Entity\Party;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 20; $i++) {
            $party = new Party();
            $party->setName('Party '.$i);
            $manager->persist($party);
            $manager->flush();
        }
    }
}
