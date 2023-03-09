<?php

namespace App\DataFixtures;

use Faker\Factory;
use Faker\Generator;
use App\Entity\Product;
use App\DataFixtures\CategoryFixtures;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class AppFixtures extends Fixture implements DependentFixtureInterface
{
    private Generator $faker;

    public function __construct()
    {
        $this->faker = Factory::create('fr_FR');
    }

    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 10; $i++) {
            $product = new Product();
            $product->setNom($this->faker->name());
            $product->setDescription('Un produit vraiment génial');
            $product->setPrice(mt_rand(50, 500));
            $product->setStock(mt_rand(50, 500));
            $product->setImage('/images/shoes-img2.png');
            $product->setIdCategory($this->getReference(CategoryFixtures::ADMIN_USER_REFERENCE));
            

            $manager->persist($product);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            CategoryFixtures::class,
        ];
    }
}  
