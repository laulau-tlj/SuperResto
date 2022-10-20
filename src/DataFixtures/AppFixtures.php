<?php

namespace App\DataFixtures;

use App\Entity\Reservation;
use DateTime;
use Faker\Factory;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // On charge le générateur de Faker pour créer les fausses données
        $faker = Factory::create('fr_FR');
        // On lance une boucle pour la création de 10 catégories
        for ($i = 0; $i < 10; $i++) {
            // On instancie l'entité Category pour générer une nouvelle catégorie
            $reservation = new Reservation;
            // On donne un nom à la catégorie générée
            $reservation->setNom($faker->name());
            $reservation->setTelephone($faker->phoneNumber());
            $reservation->setMail($faker->email());
            $reservation->setDate($faker->dateTime());
            $reservation->setNbre($faker->randomNumber(1));
            $reservation->setStatut($faker->numberBetween(0, 1));

            // On met en file d'attente la category pour qu'elle soit enregistrée en BDD
            $manager->persist($reservation);
        }
        // Une fois les catégories générées on flush pour exécuter toutes nos requêtes d'insertion en attente.
        $manager->flush();
    }
}
