<?php

namespace App\Repository;

use App\Entity\Contactanos;
use DateTime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Contactanos>
 *
 * @method Contactanos|null find($id, $lockMode = null, $lockVersion = null)
 * @method Contactanos|null findOneBy(array $criteria, array $orderBy = null)
 * @method Contactanos[]    findAll()
 * @method Contactanos[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContactanosRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Contactanos::class);
    }

    public function add(Contactanos $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Contactanos $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
    
    public function addMessage( $name, $email, $content_msn, $em )
    {
      $register_msn = new Contactanos();
      $register_msn->setNombre( $name );
      $register_msn->setFecha( new DateTime() );
      $register_msn->setCorreo( $email );
      $register_msn->setMensaje( $content_msn );
      $em->persist( $register_msn );
      // dd($register_msn);
      try {
        $em->flush();
      } catch (\Throwable $th) {
        return 'error';
      }

    }
    

//    /**
//     * @return Contactanos[] Returns an array of Contactanos objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Contactanos
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
