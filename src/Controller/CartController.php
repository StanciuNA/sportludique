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
use App\Container\CartManager;


#[Route('/cart')]
class CartController extends AbstractController
{
    public function cart(EntityManagerInterface $entityManager,Request $request): Response
    {

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
                $totalPrice += $quantity->getBulkPrice();
                array_push($result,$quantity);
            }
   
        }

        return $this->renderForm('cart.html.twig',[
            'Products' => $result,
            'totalPrice' => $totalPrice
        ]);

    }


    public function addProduct(EntityManagerInterface $entityManager,Request $request)
    {

        $productId = $request->request->get('productId');
        $user = $this->getUser();
        $lastCart = $entityManager->getRepository(cart::class)->findBy(['idPerson' => $user->getId()]);
        if(!$lastCart){
            $lastCart = new Cart();
            $date = date_create_from_format('Y-m-d H:i:s', date('Y-m-d H:i:s'));
            $lastCart->setDate($date);
            $lastCart->setIdPerson($user);
            $entityManager->persist($lastCart);
            $entityManager->flush();
        }

        $userId= strval($user->getId());
        $cartContent = $entityManager->getRepository(CartContent::class)->findBy(
            ['cartId' => $lastCart,'productId' => $productId]
        );
        if(!$cartContent){
            $cartContent = new CartContent;
            $cartContent->setCartId($lastCart[0]);
            $product = $entityManager->getRepository(product::class)->findBy(['id' => $productId]);
            $cartContent->setProductId($product[0]);
            $cartContent->setQuantity(1);
            $entityManager->persist($cartContent);
            $entityManager->flush();
        }
        else{
            
            $cartContent[0]->setQuantity($cartContent[0]->getQuantity()+1);
            $entityManager->persist($cartContent[0]);
            $entityManager->flush();

            }
            dump($cartContent);
            

            $response = new Response(
                $productId,
                Response::HTTP_OK,
                ['content-type' => 'text/plain']
            );

            $response->setContent($productId);

        if($lastCart == null ){
            dump($lastCart);
    }
    return $response;
    
    }

    public function removeContent(EntityManagerInterface $entityManager,Request $request): JsonResponse
    {
        $requestData = $request->request->get('CartContentId');
        //dump($requestData);

        try{

            $cartContent = $entityManager->getRepository(cartContent::class)->findBy(['id' => $requestData]);
            if (!$cartContent) {
            
                throw $this->createNotFoundException('Object not found');
                $responseData = ['result' => 'failiure'];
            
            }
            else{

                $entityManager->remove($cartContent[0]);
                $entityManager->flush();
                $responseData = ['result' => 'success'];

            }
            
        }

        catch(exception $e){
            $responseData = ['result' => 'failiure'];
        }
        
        
        return new JsonResponse($responseData);

    }

    public function updateContent(EntityManagerInterface $entityManager,Request $request): JsonResponse{
        $quantity = $request->request->get('quantity');
        $cartId = $request->request->get('cartId');
        dump($request);
        $responseData = ['result' => 'success'];
        return new JsonResponse($responseData);
    }
}