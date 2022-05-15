<?php

namespace App\DataFixtures;

use App\Entity\Categorie;
use App\Entity\Produit;
use App\Entity\User;

use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ProductFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
       
        $faker = \Faker\Factory::create('fr_FR');

        $categorie = new Categorie;

            $categorie ->setTitre('Truc');
            $manager->persist($categorie);
        $manager->flush();

        $user = new User;

            $user ->setUsername('bitchass')
                ->setPassword('Damnson')
                ->setEmail('nova77230@gmail.com');
                $manager->persist($user);
            $manager->flush();
            
        for($i = 1; $i <= mt_rand(8, 10); $i++)
        {
            $product = new Produit;
            

            
            $product->setNom($faker->sentence(3))
                ->setUserId($user)
                ->setImage($faker->imageUrl)
                ->setCategorieId($categorie)
                ->setPrix($faker->randomFloat(2, 10, 100))
                ->setDescription($faker->sentence(5));
            $manager->persist($product);
        }
        $manager->flush();
    }
}
