<?php

namespace App\DataFixtures;

use App\Entity\Menu;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        //On charge le générateur de Faker pour créer des fausses données
        $faker = Factory::create('fr_FR');
        //On lance une boucle pour la création des 10 catégories
        for ($i=0; $i < 10; $i++) {
            //On instancie l'entité Category pour générer une nouvelle catégorie
            $menu = new Menu;
            //on donne un nom à la catégorie générée
            $menu->setNom($faker->words(3, true))
                 ->setPrix($faker->paragraphs(4, true))
                 ->setDescription($faker->paragraphs(10, true));
            //On met en file d'attente la categorie pour qu'elle soit enregistrée en BDD
            $manager->persist($menu);
                    
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
