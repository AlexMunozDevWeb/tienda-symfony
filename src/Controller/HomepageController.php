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
    $products = $this->em->getRepository( Productos::class )->getAllProducts();
    $productsCategories = $this->em->getRepository( Productos::class )->getAllProductsCatsId();
    $session_started = $this->em->getRepository( Usuarios::class )->checkSessionStart( $sess );
    
    //Añadir imagen
    for ($i=0; $i < count( $products ); $i++) { 
      $img = $this->em->getRepository( Imagenes::class )->getImgsProducts( $products[$i]['id'] );
      array_push( $products[$i], $img );
    }

    return $this->render('homepage/index.html.twig', [
      'products_categories' => $productsCategories,
      'products' => $products,
      'session_started' => $session_started,
      'session' => $sess,
    ]);
  }
}
