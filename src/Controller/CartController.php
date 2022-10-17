<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
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


    return $this->render('cart/index.html.twig', [
        'session' => $session,
        // 'cantidad' => $cantidad,
        // 'id_pro' => $id_pro,
    ]);
  }
}
