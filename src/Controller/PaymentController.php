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
use App\Entity\Payment;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\CartRepository;
use App\Repository\CartContentRepository;
use App\Manager\CartManager;


class PaymentController extends AbstractController
{
    #[Route('/payment')]
    public function payment(EntityManagerInterface $entityManager,Request $request): Response{
        
        $user = $this->getUser();
        $result = array();
        if($user){
            $lastCart = $entityManager->getRepository(cart::class)->findOneBy(
                ['idPerson' => $user->getId()],
                ['idPerson' => 'DESC']);
            $cartProducts = $entityManager->getRepository(CartContent::class)->findBy(['cartId' => $lastCart]);
            
            foreach($cartProducts as $cartLine){
                
                $quantity = new CartManager();
                $product = $entityManager->getRepository(product::class)->findOneBy(['id' => $cartLine->getProductId()]);
                $quantity->setProduct($product);
                $quantity->setQuantity($cartLine->getQuantity());
                $quantity->setBulkPrice();
                $quantity->setCartContent($cartLine);
                array_push($result,$quantity);
    
            }

            foreach($result as $a){
                dump($a->getProduct()->getPrice());
                
            
            } 





        return $this->render('payment.html.twig');

    }

    

}