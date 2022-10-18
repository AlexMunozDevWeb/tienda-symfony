<?php

namespace App\Controller;

use App\Entity\Usuarios;
use App\Form\LoginType;
use App\Form\UserType;
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
    //Formulario Registro
    $user = new Usuarios();
    $register_form = $this->createForm( UserType::class ); 

    $register_form->handleRequest( $request );
    if ( $register_form->isSubmitted() && $register_form->isValid() ) {
      $plainPassword = $register_form->get( 'password' )->getData();
      // $hashedPassword = $passwordHasher->hashPassword( $user, $plainPassword );
      $user->setPassword($plainPassword);
      $user->setRoles(["Role_user"]);
      $user->setCorreo( $register_form->get( 'correo' )->getData() );
      $user->setDireccion( $register_form->get( 'direccion' )->getData() );
      $user->setCP( $register_form->get( 'CP' )->getData() );
      $user->setCiudad( $register_form->get( 'ciudad' )->getData() );
      $user->setPais( $register_form->get( 'pais' )->getData() );

      $this->em->persist( $user );
      $this->em->flush();
      
      $login_form = $this->createForm( LoginType::class ); 

      return $this->render('login/index.html.twig', [
        'session_started' => false,
        'register_done' => true,
        'login_form' => $login_form->createView(),
      ]);

    }

    //Formulario Login
    $login_form = $this->createForm( LoginType::class ); 
    $login_form->handleRequest( $request );
    $user_correo = $login_form->get( 'correo' )->getData();
    $user_pass = $login_form->get( 'password' )->getData();

    $user_creden = $this->em->getRepository( Usuarios::class )->checkCredenciales( $user_correo, $user_pass );
    $this->em->getRepository( Usuarios::class )->sessionStart( $sess, $user_creden );
    $session_started = $this->em->getRepository( Usuarios::class )->checkSessionStart( $sess );

    if( $session_started ){
      return $this->redirectToRoute('app_homepage');
    }

    return $this->render('login/index.html.twig', [
      'register_done' => false,
      'login_form' => $login_form->createView(),
      'registration_form' => $register_form->createView(),
      'session_started' => $session_started,
    ]);
  }
}
