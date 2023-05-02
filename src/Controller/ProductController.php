<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/product')]
class ProductController extends AbstractController
{
    #[Route('/', name: 'app_product_index', methods: ['GET'])]
    public function index(ProductRepository $productRepository): Response
    {
        return $this->render('product/index.html.twig', [
            'products' => $productRepository->findAll(),
        ]);
    }

    // #[Route('/new', name: 'app_product_new', methods: ['GET', 'POST'])]
    // public function new(Request $request, ProductRepository $productRepository): Response
    // {
    //     $product = new Product();
    //     $form = $this->createForm(ProductType::class, $product);
    //     $form->handleRequest($request);

    //     if ($form->isSubmitted() && $form->isValid()) {
    //         $productRepository->save($product, true);

    //         return $this->redirectToRoute('app_product_index', [], Response::HTTP_SEE_OTHER);
    //     }

    //     return $this->renderForm('product/new.html.twig', [
    //         'product' => $product,
    //         'form' => $form,
    //     ]);
    // }

    #[Route('/{id}', name: 'app_product_show', methods: ['GET', 'POST'])]
    public function show(Product $product): Response
    {
        
        return $this->render('product/show.html.twig', [
            'product' => $product,
        ]);
    }

}
