<?php


use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ProductTest extends KernelTestCase
{
    public function testProductCreationAndPersistence(): void
    {
        self::bootKernel();

        $entityManager = static::getContainer()->get('doctrine.orm.entity_manager');

        $product = new Product();
        $product->setNom('Test Product');
        $product->setDescription('This is a test product.');
        $product->setIdCategory(52);

        $entityManager->persist($product);
        $entityManager->flush();

        $productFromDatabase = $entityManager->getRepository(Product::class)->findOneBy(['nom' => 'Test Product']);

        $this->assertNotNull($productFromDatabase);
        $this->assertSame('This is a test product.', $productFromDatabase->getDescription());
    }
}
