<?php


use App\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CategoryTest extends KernelTestCase
{
    public function testCategoryCreationAndPersistence(): void
    {
        self::bootKernel();

        $entityManager = static::getContainer()->get('doctrine.orm.entity_manager');

        $category = new Category();
        $category->setLabel('Test Category');
       
        

        $entityManager->persist($category);
        $entityManager->flush();

        $categoryFromDatabase = $entityManager->getRepository(Category::class)->findOneBy(['label' => 'Test Category']);

        $this->assertNotNull($categoryFromDatabase);
        $this->assertSame('Test Category', $categoryFromDatabase->getLabel());
    }
}