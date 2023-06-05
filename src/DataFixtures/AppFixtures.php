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
        //$this->faker = Factory::create('fr_FR');
        $this->faker = \Faker\Factory::create();
        $this->faker->addProvider(new \Bezhanov\Faker\Provider\Commerce($this->faker));
    }

    public function load(ObjectManager $manager): void
    {
        $Shoesjson = file_get_contents(__DIR__.'/shoes.json');
        $shoes = json_decode($Shoesjson, true);

        $Clothesjson = file_get_contents(__DIR__.'/clothes.json');
        $clothes = json_decode($Clothesjson, true);

        $Accessjson = file_get_contents(__DIR__.'/access.json');
        $access = json_decode($Accessjson, true);

        foreach($shoes['items'] as $item) {
            $product = new Product();
            $product->setNom($item['title']);
            $product->setDescription('Des chaussures vraiment géniales');
            $product->setPrice(mt_rand(50, 100));
            $product->setStock(mt_rand(50, 500));
            $product->setImage('/images/shoes-img2.png');
            $product->setIdCategory($this->getReference(CategoryFixtures::SHOES_CATEGORY_REFERENCE));
            

            $manager->persist($product);
        }

        foreach($clothes['items'] as $item) {
            $product = new Product();
            $product->setNom($item['title']);
            $product->setDescription('Des vêtement incroyables');
            $product->setPrice(mt_rand(5000, 1000000));
            $product->setStock(mt_rand(50, 500));
            $product->setImage('/images/shoes-img2.png');
            $product->setIdCategory($this->getReference(CategoryFixtures::CLOTHING_CATEGORY_REFERENCE));
            

            $manager->persist($product);
        }

        foreach($access['items'] as $item) {
            $product = new Product();
            $product->setNom($item['title']);
            $product->setDescription('Des accessoires à réver');
            $product->setPrice(mt_rand(5000, 1000000));
            $product->setStock(mt_rand(50, 500));
            $product->setImage('/images/shoes-img2.png');
            $product->setIdCategory($this->getReference(CategoryFixtures::ACCESS_CATEGORY_REFERENCE));
            

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
