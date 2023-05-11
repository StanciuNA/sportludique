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
    #[Route('/orderRecap')]
    public function index(EntityManagerInterface $entityManager,Request $request): Response{
        
        $user = $this->getUser();
        $result = array();
        $totalPrice = 0;
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

                $totalPrice += $quantity->getBulkPrice() * $quantity->getQuantity();
    
            }
    
            foreach($result as $a){
                dump($a->getProduct()->getNom());
            
            }   
        }



        // Transmission des valeurs à la vue
        return $this->render('payment.html.twig', [
            'Products' => $result,
            'totalPrice'=>$totalPrice,
            'user'=>$user,
        ]);

    }


    


    

    

}

