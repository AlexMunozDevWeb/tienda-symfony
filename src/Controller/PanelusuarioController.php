<?php

namespace App\Controller;

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

    return $this->render('panelusuario/index.html.twig', [
      'session_started'   => $session_started,
      'cart_empty'        => $session->has('carrito'),
      'quantity_products' => $session->has( 'carrito' ) ? count($cart_detail) : '',
    ]);
  }
}
