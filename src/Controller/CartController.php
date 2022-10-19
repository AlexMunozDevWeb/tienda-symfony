<?php

namespace App\Controller;

use App\Entity\Pedidos;
use App\Entity\Productos;
use App\Entity\Usuarios;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

use function PHPUnit\Framework\isNull;

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
    
    if ($session->has('carrito')) {
      $cart_detail = $this->em->getRepository( Productos::class )->getCart( $session );
    }
    
    return $this->render('cart/index.html.twig', [
        'session'           => $session,
        'session_started'   => $session_started,
        'cart_empty'        => $session->has('carrito'),
        'quantity_products' => $session->has( 'carrito' ) ? count($cart_detail) : '',
        'details_cart'      => isset( $cart_detail ) ? $cart_detail : '',
        'checkout_done'     => $session->has('compra_realizada') ? true : false,
    ]);
  }

  #[Route('/cart/{id}', name: 'app_cart_remove')]
  public function delete_row( SessionInterface $session, $id ): Response
  {
    $cart = $session->get('carrito');
    unset($cart[$id]);
    if( count($cart) == 0 ){
      $session->remove('carrito');
    }else{
      $cart = $session->set('carrito', $cart);
    }
    return $this->redirectToRoute('app_cart');
  }

  #[Route('/cart/checkout', name: 'cart_checkout')]
  public function checkout( SessionInterface $session ): Response
  {
    $cart_detail = $this->em->getRepository( Productos::class )->getCart( $session );
    $this->em->getRepository( Pedidos::class )->checkout( $cart_detail, $this->em, $session );
    
    return $this->redirectToRoute('app_cart');
  }
  
  #[Route('/cart/remove', name: 'cart_remove_data')]
  public function remove_data( SessionInterface $session ): Response
  {
    $session->remove( 'carrito' );
    $session->remove( 'compra_realizada' );
    return $this->redirectToRoute('app_cart');
  }

}
