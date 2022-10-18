<?php

namespace App\Controller;

use App\Entity\Productos;
use App\Entity\Usuarios;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
  
  /**
   * @param $em
   */
  public function __construct( EntityManagerInterface $em )
  {
    $this->em = $em;  
  }

  #[Route('/cart', name: 'app_cart')]
  public function index( Session $session ): Response
  {

    if( isset($_POST['quantity']) && isset($_POST['id_pro']) ){
      $cantidad = $_POST['quantity'];
      $id_pro = $_POST['id_pro'];
  
      $cart_session = $session->get('carrito');
      if ( is_null( $cart_session ) ) {
        $cart_session = array();
      }
      if ( isset( $car_session[ $id_pro ] ) ) {
        $cart_session[ $id_pro ][ 'unidades' ] += intval( $cantidad );
      }else{
        $cart_session[ $id_pro ][ 'unidades' ] = intval( $cantidad );
      }
      $session->set( 'carrito', $cart_session );
    }
    
    $session_started = $this->em->getRepository( Usuarios::class )->checkSessionStart( $session );
    
    $cart_detail = $this->em->getRepository( Productos::class )->getCart( $session );

    return $this->render('cart/index.html.twig', [
        'session'           => $session,
        'session_started'   => $session_started,
        'cart_empty'        => $session->has('carrito'),
        'quantity_products' => $session->has( 'carrito' ) ? count($cart_detail) : '',
        'details_cart'      => isset($cart_detail) ? $cart_detail : '',
    ]);
  }
}
