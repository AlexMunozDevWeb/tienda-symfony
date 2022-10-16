<?php

namespace App\Controller;

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
  public function index( Session $sess ): Response
  {
    $session_started = $this->em->getRepository( Usuarios::class )->checkSessionStart( $sess );
    return $this->render('productos_page/index.html.twig', [
      'session_started' => $session_started,
    ]);
  }
}
