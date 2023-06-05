<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\User;
use App\Entity\Product;
use App\Entity\Cart;
use App\Entity\Adress;
use App\Entity\CartContent;
use App\Entity\Payment;
use App\Repository\CartRepository;
use App\Repository\CartContentRepository;
use App\Manager\CartManager;
use App\Form\AdressType;


class PaymentController extends AbstractController
{
    private $passerelle;
    private $manager;

    public function _construct(EntityManagerInterface $manager)
    {
        $this->passerelle=Omnipay::create('Paypal_Rest');
        $this->passerelle->setClientId($_ENV['PAYPAL_CLIENT_ID']);
        $this->passerelle->setSecret($_ENV['PAYPAL_SECRET_KEY']);
        $this->passerelle->setTestMode(true);

        $this->manager=$manager;
        
    }

    #[Route('/orderRecap' , name : 'app_orderRecap')]
    public function index(EntityManagerInterface $entityManager,Request $request): Response{
        
        $user = $this->getUser();
        $result = array();
        $totalPrice = 0;
        if($user){
            $adress = $entityManager->getRepository(Adress::class)->findOneBy(['idUser' => $this->getUser()]);
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

        $token=$request->request->get('token');

        if(!$this->isCsrfTokenValid('myform',$token))
        {
             return new Response('Operation non autorisée', Response::HTTP_BAD_REQUEST,
             ['content-type'=>'text/plain']);
        }
 
 
        $response=$this->passerelle->purchase(array(
         'amount'=>$request->request->get('amount'),
         'currency'=>$_ENV['PAYPAL_CURRENCY'],
         'returnUrl'=>'https://127.0.0.1:8000/success',
         'cancelUrl'=>'https://127.0.0.1:8000/erreur'
       
         ))->send();

      
         try {
             if($response->isRedirect())
             {
                 $response->redirect();
             }
 
             else
             {
                 return $response->getMessage();
             }
         } catch (\Throwable $th) {
             
             return $th->getMessage();
         }
       




        // Transmission des valeurs à la vue
        return $this->render('payment.html.twig', [
            'Products' => $result,
            'totalPrice'=>$totalPrice,
            'user'=>$user,
            'adress' => $adress,
        ]);

    }





    #[Route('/adressInformation', name:'app_informations')]
    public function adressInformation(EntityManagerInterface $entityManager, Request $request): Response
    {
        $user = $this->getUser();
        $Adress = new Adress();
        $Adress->setIdUser($user);
        $form = $this->createForm(AdressType::class, $Adress);
        $form->handleRequest($request);

    // Vérification de la validation du formulaire
    if ($form->isSubmitted() && $form->isValid()) {
        // Enregistrement des données dans la base de données
      
        $entityManager->persist($Adress);
        $entityManager->flush();

        // Redirection vers une autre page après l'enregistrement
        return $this->redirectToRoute('app_orderRecap');
    }

        return $this->render('adress.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /*#[Route('/payment', name: 'app_payment')]
    public function payment(Request $request):Response
    {
        
        return $this->render('payment.html.twig');
            

    }*/

    #[Route('/sucess', name: 'app_success')]
    public function success():Response
    {
        dd('success');
            

    }

    #[Route('/erreur', name: 'app_erreur')]
    public function erreur():Response
    {
        dd('erreur');
            

    }


    


    

    

}

