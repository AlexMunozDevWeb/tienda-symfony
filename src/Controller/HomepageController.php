<?php

namespace App\Controller;

use App\Entity\Categorias;
use App\Entity\Productos;
use App\Entity\Usuarios;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class HomepageController extends AbstractController
{
  /**
   * @param $em
   */
  public function __construct( EntityManagerInterface $em )
  {
    $this->em = $em;  
  }

  /**
   * @Route("/homepage", name="app_homepage")
   */
  public function index( Request $request, UserPasswordHasherInterface $passwordHasher ): Response
  {
    //Formulario Registro
    $user = new Usuarios();
    $register_form = $this->createForm( UserType::class ); 

    $register_form->handleRequest( $request );
    if ( $register_form->isSubmitted() && $register_form->isValid() ) {
      $plainPassword = $register_form->get( 'password' )->getData();
      $hashedPassword = $passwordHasher->hashPassword( $user, $plainPassword );

      $user->setPassword($hashedPassword);
      $user->setRoles(["Role_user"]);
      $user->setCorreo( $register_form->get( 'correo' )->getData() );
      $user->setDireccion( $register_form->get( 'direccion' )->getData() );
      $user->setCP( $register_form->get( 'CP' )->getData() );
      $user->setCiudad( $register_form->get( 'ciudad' )->getData() );
      $user->setPais( $register_form->get( 'pais' )->getData() );

      $this->em->persist( $user );
      $this->em->flush();
      
      return $this->redirectToRoute( 'app_homepage' );
    }
    
    //Datos homepage
    $products = $this->em->getRepository( Productos::class )->getAllProducts();
    $productsCategories = $this->em->getRepository( Productos::class )->getAllProductsCatsId();

    return $this->render('homepage/index.html.twig', [
      'products_categories' => $productsCategories,
      'products' => $products,
      'registration_form' => $register_form->createView(),
    ]);
  }
}
