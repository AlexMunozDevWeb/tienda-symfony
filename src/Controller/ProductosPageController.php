<?php

namespace App\Controller;

use App\Entity\Imagenes;
use App\Entity\Productos;
use App\Entity\Usuarios;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

class ProductosPageController extends AbstractController
{
  /**
   * @param $em
   */
  public function __construct( EntityManagerInterface $em )
  {
    $this->em = $em;  
  }
  /**
   * @Route("/productos/{id}", name="app_productos_page")
   */
  public function index( Session $sess, $id ): Response
  {

    $session_started = $this->em->getRepository( Usuarios::class )->checkSessionStart( $sess );
    $product = $this->em->getRepository( Productos::class )->find( $id );
    $stock = $this->em->getRepository( Productos::class )->getProductStock( $id );
    $img_product = $this->em->getRepository( Imagenes::class )->getImgsProducts( $id );

    return $this->render('productos_page/index.html.twig', [
      'session_started' => $session_started,
      'id'              => $id,
      'product'         => $product,
      'imgs'            => $img_product,
      'stock'           => $stock
    ]);
  }
}
