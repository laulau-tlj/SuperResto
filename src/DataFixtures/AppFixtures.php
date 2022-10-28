<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Menu;
use App\Entity\Reservation;
use App\Entity\Utilisateurs;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        //On charge le générateur de Faker pour créer des fausses données
        $faker = Factory::create('fr_FR');
        //on crée 10 utilisateurs avec noms et prénoms "aléatoires" en français
        //On lance une boucle pour la création des 10 menus
        for ($i=0; $i < 10; $i++) {
            //On instancie l'entité Category pour générer une nouvelle catégorie
            $menu = new Menu;
            //on donne un nom à la catégorie générée
            $menu->setNom($faker->name)
                 ->setPrix($faker->numberBetween($min = 19, $max = 45))
                 ->setDescription($faker->words(3, true))
                 ->setImage($faker->imageUrl($width = 640, $height = 480));
            //On met en file d'attente la categorie pour qu'elle soit enregistrée en BDD
            $manager->persist($menu);
        }
        
        // On lance une boucle pour la création des réservations
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
                    
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }


}

}