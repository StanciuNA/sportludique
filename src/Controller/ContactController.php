<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/category')]
class ContactController extends AbstractController
{
    public function contact(): Response
    {
        return $this->render('contact.html.twig');
    }
}