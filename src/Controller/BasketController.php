<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/basket')]
class BasketController extends AbstractController
{
    public function basket(): Response
    {
        return $this->render('basket.html.twig');
    }
}