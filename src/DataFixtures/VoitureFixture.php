<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Voiture;

class VoitureFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {

        for($i=1; $i<=10; $i++){
            $voiture = new Voiture();

            $voiture->setName('voiture numero '.$i)
                    ->setBrand('marque numero '.$i)
                    ->setPrice('1550000')
                    ->setCreatedAt(new \DateTime());

            $manager->persist($voiture);

        }

        $manager->flush();
    }
}
