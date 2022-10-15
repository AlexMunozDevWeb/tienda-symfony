<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LogoutController extends AbstractController
{
    #[Route('/logout', name: 'app_logout')]
    public function index(): Response
    {
      unset( $_SESSION['correo'] );
      return $this->redirectToRoute('app_homepage');
      // return $this->redirectToRoute('app_login');
    }
}
