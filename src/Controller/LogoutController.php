<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

class LogoutController extends AbstractController
{
    #[Route('/logout', name: 'app_logout')]
    public function index( Session $sess ): Response
    {
      if( $sess->has('carrito') ){
        $sess->remove('carrito');
      }
      $sess->remove('correo');
      return $this->redirectToRoute('app_homepage');
    }
}
