<?php

namespace App\Controller;

use App\Entity\Contactanos;
use App\Entity\Productos;
use App\Entity\Usuarios;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class ContactoController extends AbstractController
{

  /**
   * @param $em
   */
  public function __construct( EntityManagerInterface $em )
  {
    $this->em = $em;  
  }

  #[Route('/contacto', name: 'app_contacto')]
  public function index( SessionInterface $session ): Response
  {
    $session_started = $this->em->getRepository( Usuarios::class )->checkSessionStart( $session );
    $cart_detail = $this->em->getRepository( Productos::class )->getCart( $session );
    return $this->render('contacto/index.html.twig', [
      'session_started' => $session_started,
      'cart_empty' => $session->has('carrito'),
      'quantity_products' => $session->has( 'carrito' ) ? count($cart_detail) : '',
    ]);
  }

  #[Route('/contacto/enviar', name: 'app_send_msn')]
  public function send(): Response
  {
    //Formulario mandar mensaje
    if ( isset( $_POST[ 'nombre' ] ) && isset( $_POST[ 'correo' ] ) && isset( $_POST[ 'msn-content' ] ) ) {
      $name = $_POST[ 'nombre' ];
      $email = $_POST[ 'correo' ];
      $content_msn = $_POST[ 'msn-content' ];
      $this->em->getRepository( Contactanos::class )->addMessage( $name, $email, $content_msn, $this->em );
    }
    return $this->redirectToRoute('app_homepage');
  }
}
