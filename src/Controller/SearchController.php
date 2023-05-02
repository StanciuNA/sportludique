<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\User;
use App\Entity\Product;
use App\Entity\Cart;
use App\Entity\CartContent;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\CartRepository;
use App\Repository\CartContentRepository;
use App\Manager\CartManager;


#[Route('/search')]
class SearchController extends AbstractController
{
    
}