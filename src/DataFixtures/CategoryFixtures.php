<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\FixtureInterface;


class CategoryFixtures extends Fixture
{
    public const ADMIN_USER_REFERENCE = 'admin-user';

    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 4; $i++) {
            $category = new Category();
            $category->setLabel('categorie '.$i);
            
        

            $manager->persist($category);
        }

        $manager->flush();

        $this->addReference(self::ADMIN_USER_REFERENCE, $category);
    }


}  