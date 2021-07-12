<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Voiture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $date = new \DateTime('@'.strtotime('now'));

        $voiture = new Voiture();
        $voiture->setName('test');
        $voiture->setBrand('test');
        $voiture->setPrice(1000);
        $voiture->setCreatedAt(new \DateTime());
        $manager->persist($voiture);

        $manager->flush();
    }
}
