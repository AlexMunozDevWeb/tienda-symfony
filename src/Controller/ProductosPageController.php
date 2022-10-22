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

    $session_started = $this->em->getRepository( Usuarios::class )->checkSessionStart( $sess );

    $cart_detail = $this->em->getRepository( Productos::class )->getCart( $sess );
    
    //Most sell products
    $most_sell_products = $this->em->getRepository( Productos::class )->mostSellProducts();
    //Añadir imagen
    for ($i=0; $i < count( $most_sell_products ); $i++) { 
      $img = $this->em->getRepository( Imagenes::class )->getImgsProducts( $most_sell_products[$i]['id'] );
      $most_sell_products[$i]['url_img'] = $img[0]['url'];
    }
    //Añadir nombre del productos
    for ($i=0; $i < count( $most_sell_products ); $i++) { 
      $product_name = $this->em->getRepository( Productos::class )->getNameProduct( $most_sell_products[$i]['id'] );
      $most_sell_products[$i]['name'] = $product_name[0]['nombre'];
    }

    return $this->render('productos_page/index.html.twig', [
      'session_started'   => $session_started,
      'id'                => $id,
      'product'           => $product,
      'imgs'              => $img_product,
      'stock'             => $stock,
      'session_started'   => $session_started,
      'cart_empty'        => $sess->has('carrito'),
      'quantity_products' => $sess->has( 'carrito' ) ? count($cart_detail) : '',
      //Most sell products
      'most_sell_products'=> $most_sell_products,
    ]);
  }
}
