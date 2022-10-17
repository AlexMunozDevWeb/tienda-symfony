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
