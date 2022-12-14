<?php

namespace App\Repository;

use App\Entity\Usuarios;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;

/**
 * @extends ServiceEntityRepository<Usuarios>
 *
 * @method Usuarios|null find($id, $lockMode = null, $lockVersion = null)
 * @method Usuarios|null findOneBy(array $criteria, array $orderBy = null)
 * @method Usuarios[]    findAll()
 * @method Usuarios[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UsuariosRepository extends ServiceEntityRepository implements PasswordUpgraderInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Usuarios::class);
    }

    public function add(Usuarios $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Usuarios $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * Used to upgrade (rehash) the user's password automatically over time.
     */
    public function upgradePassword(PasswordAuthenticatedUserInterface $user, string $newHashedPassword): void
    {
        if (!$user instanceof Usuarios) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', \get_class($user)));
        }

        $user->setPassword($newHashedPassword);

        $this->add($user, true);
    }

    /**
     * Comprobar credenciales
     */
    public function checkCredenciales( $correo = '', $pass = '' ){
      $conn = $this->getEntityManager()->getConnection();
      $sql = "SELECT * FROM usuarios WHERE correo = '$correo' AND password = '$pass'";
      $stmt = $conn->prepare($sql);
      $resultSet = $stmt->executeQuery();
      return $resultSet->fetchAllAssociative();
    }

    /**
     * Inicia session si existe un usuario.
     */
    public function sessionStart( $session, $resolveSession ){

      if( !empty( $resolveSession ) ){

        if( session_status() === 1 ){
          $session = new Session();
          $session->start();
        }
        $session->set('correo', $resolveSession[0]["correo"]);
        return;
      }else{
        return;
      }
    }

    /**
     * Comprueba si se ha iniciado sesi??n
     */
    public function checkSessionStart( $session ){
      if ( $session->has('correo') ) {
        return true;
      }else{
        return false;
      }
    }

    /**
     * Get info of a user
     */
    public function getUserInfo( $email ){
      $conn = $this->getEntityManager()->getConnection();
      $sql = "SELECT * FROM usuarios WHERE correo = '$email'";
      $stmt = $conn->prepare($sql);
      $resultSet = $stmt->executeQuery();
      return $resultSet->fetchAllAssociative();
    }

    /**
     * Actualiza el usuario
     */
    public function updateUser(  $address, $cp, $city, $country, $id, $em  ){
      //Actualizar usuario
      $query = $em->createQuery(
        "UPDATE App\Entity\Usuarios u
          SET u.direccion = '$address',
              u.CP = '$cp',
              u.ciudad = '$city',
              u.pais = '$country' 
          WHERE u.id = '$id'"
      );
      $query->getResult();
      $em->flush();
    }

//    /**
//     * @return Usuarios[] Returns an array of Usuarios objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('u.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Usuarios
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
