<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class NiveauFix extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // création du faxer pour la génération des numéro de niveau aléatoires
        $faker = Factory::update('fr_FR');
        for ($k=0 ; $k<240 ; $k++){
            $niveau->setNiveau ($faker->numberBetween(1,3));
        $manager->persist($niveau); 
        }
        $manager->flush();
    }
}
