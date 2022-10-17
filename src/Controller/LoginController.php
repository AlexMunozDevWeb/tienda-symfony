<?php

namespace App\Controller;

use App\Entity\Usuarios;
use App\Form\LoginType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
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
  public function index( Request $request, Session $sess ): Response
  {

    //Formulario Login
    $login_form = $this->createForm( LoginType::class ); 
    $login_form->handleRequest( $request );
    $user_correo = $login_form->get( 'correo' )->getData();
    $user_pass = $login_form->get( 'password' )->getData();

    $user_creden = $this->em->getRepository( Usuarios::class )->checkCredenciales( $user_correo, $user_pass );
    $prueba =  $this->em->getRepository( Usuarios::class )->sessionStart( $sess, $user_creden );
    $session_started = $this->em->getRepository( Usuarios::class )->checkSessionStart( $sess );

    // if( $session_started ){
    //   return $this->redirectToRoute('app_homepage');
    // }

    return $this->render('login/index.html.twig', [
      'controller_name' => 'LoginController',
      'login_form' => $login_form->createView(),
      'correo' => $user_correo,
      'session_started' => $session_started,
    ]);
  }
}