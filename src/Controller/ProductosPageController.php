<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductosPageController extends AbstractController
{
  /**
   * @Route("/productos/{id}", name="app_productos_page")
   */
  public function index( $id ): Response
  {
    return $this->render('productos_page/index.html.twig', [
      'controller_name' => 'ProductosPageController',
    ]);
  }
}
