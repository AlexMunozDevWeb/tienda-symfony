<?php

namespace App\Repository;

use App\Entity\Productos;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Productos>
 *
 * @method Productos|null find($id, $lockMode = null, $lockVersion = null)
 * @method Productos|null findOneBy(array $criteria, array $orderBy = null)
 * @method Productos[]    findAll()
 * @method Productos[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductosRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Productos::class);
    }

    public function add(Productos $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Productos $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function getAllProductsCatsId(){
      $conn = $this->getEntityManager()->getConnection();
      $sql = 'SELECT cat.id as id, cat.nombre, IFNULL( products.cantidad, 0 ) as cantidad
              FROM categorias cat
              RIGHT JOIN(
                  SELECT pro.id_cat_id as id, count( pro.id_cat_id ) as cantidad
                  FROM productos pro 
                  GROUP BY pro.id_cat_id
              ) as products ON cat.id = products.id';
      $stmt = $conn->prepare($sql);
      $resultSet = $stmt->executeQuery();
      return $resultSet->fetchAllAssociative();
    }
    public function getAllProducts(){
      $conn = $this->getEntityManager()->getConnection();
      $sql = 'SELECT * FROM productos';
      $stmt = $conn->prepare($sql);
      $resultSet = $stmt->executeQuery();
      return $resultSet->fetchAllAssociative();
    }
    public function getProductStock( $id ){
      $conn = $this->getEntityManager()->getConnection();
      $sql = "SELECT stock FROM productos WHERE id = '$id'";
      $stmt = $conn->prepare($sql);
      $resultSet = $stmt->executeQuery();
      return $resultSet->fetchAllAssociative();
    }
    
    /**
     * Get cart if exists
     */
    public function getCart( $session ){
      $cart_detail = '';
      if( $session->has( 'carrito' ) ){
        $cart_session = $session->get( 'carrito');
        $keys_cart = array_keys( $cart_session );
        $cart_detail = array(['id_pro' => 0,'cantidad' => '']);
    
        for ($i=0; $i < count($cart_session); $i++) { 

          $correo_user = $session->get('correo');
          $conn = $this->getEntityManager()->getConnection();
          $sql = "SELECT id FROM usuarios WHERE correo = '$correo_user'";
          $stmt = $conn->prepare($sql);
          $resultSet = $stmt->executeQuery();
          $imgs = $resultSet->fetchAllAssociative();
          $cart_detail[$i]['usuario_id'] = $imgs[0]['id'];

          $conn = $this->getEntityManager()->getConnection();
          $sql = "SELECT url FROM imagenes WHERE id_producto_id = '$keys_cart[$i]'";
          $stmt = $conn->prepare($sql);
          $resultSet = $stmt->executeQuery();
          $imgs = $resultSet->fetchAllAssociative();
          $cart_detail[$i]['url_img'] = $imgs[0]['url'];
          
          $conn = $this->getEntityManager()->getConnection();
          $sql = "SELECT nombre, precio FROM productos WHERE id = '$keys_cart[$i]'";
          $stmt = $conn->prepare($sql);
          $resultSet = $stmt->executeQuery();
          $name = $resultSet->fetchAllAssociative();
          $cart_detail[$i]['product_name'] = $name[0]['nombre'];
          $cart_detail[$i]['precio'] = $name[0]['precio'];

          $cart_detail[$i]['id_pro'] = $keys_cart[$i];
          $cart_detail[$i]['cantidad'] = $cart_session[ $keys_cart[$i] ]['unidades'];
          $cart_detail[$i]['usuario'] = $correo_user;
          $cart_detail[$i]['slug'] = 'cart/';
        }
      }
      return $cart_detail;
    }

//    /**
//     * @return Productos[] Returns an array of Productos objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Productos
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
