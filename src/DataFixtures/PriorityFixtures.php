<?php

namespace App\DataFixtures;

use App\Entity\Priority;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PriorityFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $priority1 = new Priority();
        $priority1->setName('Urgent');
        $manager->persist($priority1);

        $priority2 = new Priority();
        $priority2->setName('Important');
        $manager->persist($priority2);

        $priority3 = new Priority();
        $priority3->setName('Normal');
        $manager->persist($priority3);

        $manager->flush();
    }
}
