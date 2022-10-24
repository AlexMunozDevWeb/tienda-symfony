<?php

namespace App\Controller;

use App\Entity\Imagenes;
use App\Entity\Productos;
use App\Entity\Usuarios;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class TiendaController extends AbstractController
{
  
  /**
   * @param $em
   */
  public function __construct( EntityManagerInterface $em )
  {
    $this->em = $em;  
  }

  #[Route('/tienda', name: 'app_tienda')]
  public function index(SessionInterface $session): Response
  {

    $productsCategories = $this->em->getRepository( Productos::class )->getAllProductsCatsId();

    $products = $this->em->getRepository( Productos::class )->getAllProducts();
    //Añadir imagen
    for ($i=0; $i < count( $products ); $i++) { 
      $img = $this->em->getRepository( Imagenes::class )->getImgsProducts( $products[$i]['id'] );
      array_push( $products[$i], $img );
    }

    $session_started = $this->em->getRepository( Usuarios::class )->checkSessionStart( $session );
    $cart_detail = $this->em->getRepository( Productos::class )->getCart( $session );

    return $this->render('tienda/index.html.twig', [
      'session_started' => $session_started,
      'products' => $products,
      'cart_empty' => $session->has('carrito'),
      'quantity_products' => $session->has( 'carrito' ) ? count($cart_detail) : '',
      'products_categories' => $productsCategories,
    ]);
  }
  
}
