<?php

namespace App\Controller;

use App\Entity\Categorias;
use App\Entity\Productos;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
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
  public function index(): Response
  {

    // $products = $this->em->getRepository( Productos::class )->findAll();
    $products = $this->em->getRepository( Productos::class )->getAllProducts();
    $productsCategories = $this->em->getRepository( Productos::class )->getAllProductsCatsId();

    return $this->render('homepage/index.html.twig', [
      'products_categories' => $productsCategories,
      'products' => $products,
    ]);
  }
}
