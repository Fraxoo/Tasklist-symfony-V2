<?php

namespace App\DataFixtures;

use App\Entity\Status;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class StatusFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $status1 = new Status();
        $status1->setName('Terminé');
        $manager->persist($status1);

        $status2 = new Status();
        $status2->setName('En cours');
        $manager->persist($status2);

        $manager->flush();
    }
}
