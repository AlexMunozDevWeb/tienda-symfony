<?php

namespace App\Controller;

use App\Entity\Pedidos;
use App\Entity\Productos;
use App\Entity\Usuarios;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class PanelusuarioController extends AbstractController
{
  
  /**
   * @param $em
   */
  public function __construct( EntityManagerInterface $em )
  {
    $this->em = $em;  
  }

  #[Route('/panelusuario', name: 'app_panelusuario')]
  public function index( SessionInterface $session ): Response
  {
    
    $session_started = $this->em->getRepository( Usuarios::class )->checkSessionStart( $session );
    if ($session->has('carrito')) {
      $cart_detail = $this->em->getRepository( Productos::class )->getCart( $session );
    }
    
    //Info user
    $user_email = $session->get('correo');
    $info_user = $this->em->getRepository( Usuarios::class )->getUserInfo( $user_email );

    //Get user orders
    $user_orders = $this->em->getRepository( Pedidos::class )->getUserOrders( $session->get('correo') );

    return $this->render('panelusuario/index.html.twig', [
      'session_started'   => $session_started,
      'cart_empty'        => $session->has('carrito'),
      'quantity_products' => $session->has( 'carrito' ) ? count($cart_detail) : '',
      'info_user'         => $info_user,
      'user_orders'       => $user_orders,
    ]);
  }

  /**
   * Actualiza usuario y redirige al panel
   */
  #[Route('/panelusuario/modificar', name: 'app_panelusuario_modify')]
  public function updateUser(): Response
  {
    if ( isset( $_POST[ 'address' ] ) && isset( $_POST[ 'cp' ] )
         && isset( $_POST[ 'city' ] ) && isset( $_POST[ 'country' ] ) ) {
      $address = $_POST[ 'address' ];
      $cp = $_POST[ 'cp' ];
      $city = $_POST[ 'city' ];
      $country = $_POST[ 'country' ];
      $id = $_POST[ 'id' ];
      $this->em->getRepository( Usuarios::class )
           ->updateUser( $address, $cp, $city, $country, $id, $this->em );
    }
    return $this->redirectToRoute('app_panelusuario');
  }
}
