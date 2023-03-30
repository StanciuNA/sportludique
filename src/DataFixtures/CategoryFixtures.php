<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\FixtureInterface;


class CategoryFixtures extends Fixture
{
    public const SHOES_CATEGORY_REFERENCE = 'shoes-category';
    public const CLOTHING_CATEGORY_REFERENCE = 'clothes-category';
    public const ACCESS_CATEGORY_REFERENCE = 'access-category';

    public function load(ObjectManager $manager): void
    {
        $json = file_get_contents(__DIR__.'/categories.json');
        $data = json_decode($json, true);

       
            $shoesCategory = new Category();
            $shoesCategory->setLabel('Chaussure');
            $manager->persist($shoesCategory);

            $clothesCategory = new Category();
            $clothesCategory->setLabel('Vêtement');
            $manager->persist($clothesCategory);

            $accessCategory = new Category();
            $accessCategory->setLabel('Accessoire');
            $manager->persist($accessCategory);
        

        $manager->flush();

        $this->addReference(self::SHOES_CATEGORY_REFERENCE, $shoesCategory);
        $this->addReference(self::CLOTHING_CATEGORY_REFERENCE, $clothesCategory);
        $this->addReference(self::ACCESS_CATEGORY_REFERENCE, $accessCategory);
    }


}  