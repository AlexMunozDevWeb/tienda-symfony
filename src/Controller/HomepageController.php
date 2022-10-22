<?php

namespace App\Controller;

use App\Entity\Imagenes;
use App\Entity\Productos;
use App\Entity\Usuarios;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;

class HomepageController extends AbstractController
{
  /**
   * @param $em
   */
  public function __construct( EntityManagerInterface $em )
  {
    $this->em = $em;  
  }

  /**
   * @Route("/", name="app_homepage")
   */
  public function index( Session $sess, UserPasswordHasherInterface $passwordHasher ): Response
  {
    
    //Datos homepage
    $session_started = $this->em->getRepository( Usuarios::class )->checkSessionStart( $sess );

    $cart_detail = $this->em->getRepository( Productos::class )->getCart( $sess );

    return $this->render('homepage/index.html.twig', [
      
      'session_started' => $session_started,
      'cart_empty' => $sess->has('carrito'),
      'quantity_products' => $sess->has( 'carrito' ) ? count($cart_detail) : '',
    ]);
  }
}
