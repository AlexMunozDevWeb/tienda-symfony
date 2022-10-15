<?php

namespace App\Controller;

use App\Entity\Usuarios;
use App\Form\LoginType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LoginController extends AbstractController
{
  /**
   * @param $em
   */
  public function __construct( EntityManagerInterface $em )
  {
    $this->em = $em;  
  }
  
  #[Route('/login', name: 'app_login')]
  public function index( Request $request ): Response
  {

    //Formulario Login
    $login_form = $this->createForm( LoginType::class ); 
    $login_form->handleRequest( $request );
    $user_correo = $login_form->get( 'correo' )->getData();
    $user_pass = $login_form->get( 'password' )->getData();

    $user_creden = $this->em->getRepository( Usuarios::class )->checkCredenciales( $user_correo, $user_pass );
    $prueba =  $this->em->getRepository( Usuarios::class )->sessionStart( $user_creden );

    if ( isset( $user_creden[0]['correo'] ) ) {
      $session_iniciada = TRUE;
    }else{
      $session_iniciada = FALSE;
    }

    return $this->render('login/index.html.twig', [
      'controller_name' => 'LoginController',
      'login_form' => $login_form->createView(),
      'correo' => $user_correo,
      'pass' => $user_pass,
      'creden' => $user_creden,
      'prueba' => $prueba,
      'session' => $session_iniciada,
    ]);
  }
}
