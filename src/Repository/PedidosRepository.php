<?php

namespace App\Repository;

use App\Entity\Pedidos;
use App\Entity\Productos;
use App\Entity\ProductosPedidos;
use App\Entity\Usuarios;
use DateTime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Pedidos>
 *
 * @method Pedidos|null find($id, $lockMode = null, $lockVersion = null)
 * @method Pedidos|null findOneBy(array $criteria, array $orderBy = null)
 * @method Pedidos[]    findAll()
 * @method Pedidos[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PedidosRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Pedidos::class);
    }

    public function add(Pedidos $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Pedidos $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function checkout( $cart_detail, $em, $session){

      if ( is_null( $cart_detail ) || count( $cart_detail ) == 0 ) {
        return $this->redirectToRoute('cart_checkout');
      }else {
        // dd($cart_detail);
        //Pedidos
        $pedido = new Pedidos();
        $pedido->setFecha( new DateTime() );
        $pedido->setEnviado( 0 );
        $pedido->setIdUsuario( $em->getRepository( Usuarios::class )->find( $cart_detail[0]['usuario_id'] ) );
        $em->persist( $pedido );
        for ($i=0; $i < count( $cart_detail ) ; $i++) { 
          
          //ProductosPedidos
          $productos_pedidos = new ProductosPedidos();
          $productos_pedidos->setCodProducto( $em->getRepository( Productos::class )->find( $cart_detail[$i]['id_pro'] ) );
          $productos_pedidos->setCodPedido( $pedido );
          $productos_pedidos->setUnidades( $cart_detail[$i]['cantidad'] );

          //Actualizar stock
          $cantidad = $cart_detail[$i]['cantidad'];
          $codigo = $cart_detail[$i]['id_pro'];
          $query = $em->createQuery(
            "UPDATE App\Entity\Productos p
             SET p.stock = p.stock - $cantidad 
             WHERE p.id = $codigo"
          );
          $result = $query->getResult();
          $em->persist( $productos_pedidos );

          try {
            $em->flush();
            $session->remove('carrito');
            $session->set('compra_realizada', true);
          } catch (\Throwable $th) {
            return 'error';
          }
        }

      }

    }

//    /**
//     * @return Pedidos[] Returns an array of Pedidos objects
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

//    public function findOneBySomeField($value): ?Pedidos
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
