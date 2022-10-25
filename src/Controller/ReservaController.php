<?php

namespace App\Controller;

use App\Entity\Productos;
use App\Entity\Reserva;
use App\Entity\Usuarios;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class ReservaController extends AbstractController
{
  
  /**
   * @param $em
   */
  public function __construct( EntityManagerInterface $em )
  {
    $this->em = $em;  
  }

  #[Route('/reserva/{name}/{opc}?', name: 'app_reserva')]
  public function index( SessionInterface $session, $name, $opc = 'false' ): Response
  {
    if ( isset( $_GET[ 'opc' ] ) ) {
      $opc = 'true';
    }

    $data = array();

    if ( $name === 'mikakus' ) {
      $data = [ 
        'name'        => 'mikakus', 
        'description' => 'Las New Boom Génesis son una reinterpretación de nuestras emblemáticas zapatillas multicolor: las Boom. Pensadas por y para personas con gran personalidad, se inspiran en las zapatillas de estilo chunky con especial énfasis en el máximo confort.',
        'url_img'     =>  'images/new/new-product-1.jpg',
      ];
    }
  
    if ( $name === 'giannis' || $name === 'Giannis immortality2') {
      $data = [ 
        'name'        => 'Giannis immortality2', 
        'description' => 'Pensada para personas con gran personalidad. Con una suela oversized de la casa Vibram de 3,5cm y materiales como el SEAQUAL YARN son un claro ejemplo de la moda sostenible del futuro. Además incorpora una plantilla 100% reciclada. El sistema de cordones está inspirado en las zapatillas de trail running modernas para otorgarle un aire más deportivo.',
        'url_img'     =>  'images/new/new-product-2.jpg',
      ];
    }
   
    $session_started = $this->em->getRepository( Usuarios::class )->checkSessionStart( $session );
    $cart_detail = $this->em->getRepository( Productos::class )->getCart( $session );

    return $this->render('reserva/index.html.twig', [
      'data'              => $data,
      'session_started'   => $session_started,
      'cart_empty'        => $session->has('carrito'),
      'quantity_products' => $session->has( 'carrito' ) ? count($cart_detail) : '',
      'send_order'        => $opc,
    ]);

  }

  #[Route('/reserva/enviar', name: 'app_send_reserva')]
  public function send(): Response
  {
    if ( isset( $_POST[ 'name' ] ) && isset( $_POST[ 'correo' ] ) && isset( $_POST[ 'surname' ] ) ) {
      $name = $_POST[ 'name' ];
      $surname = $_POST[ 'surname' ];
      $email = $_POST[ 'correo' ];
      $product = $_POST[ 'product' ];
      $this->em->getRepository( Reserva::class )->addReserva( $name, $surname, $email, $product, $this->em );
    }

    return $this->redirectToRoute('app_reserva', array( 'name' => $product, 'opc' => 'done' ));
  }

}
