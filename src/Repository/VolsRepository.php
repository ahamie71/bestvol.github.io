<?php

namespace App\Repository;

use App\Entity\Vols;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Vols>
 *
 * @method Vols|null find($id, $lockMode = null, $lockVersion = null)
 * @method Vols|null findOneBy(array $criteria, array $orderBy = null)
 * @method Vols[]    findAll()
 * @method Vols[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VolsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Vols::class);
    }

    public function save(Vols $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Vols $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
     
   /**
    * return Vols[] Returns an array of Vols objects
    */
  // public function rechercherajax($value): array
    //{
       // return $this->createQueryBuilder('v')
           // ->andWhere('v.exampleField = :val')
           // ->setParameter('val', $value)
           // ->orderBy('v.id', 'ASC')
           // ->setMaxResults(10)
           // ->getQuery()
           // ->getResult()
   //   ;
 //  }
 public function findAllVolsBysearch($vols):array
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.idCompany = :toto')
            ->setParameter('toto',$vols->getidCompany())
            ->andWhere('v.destination = :lieu')
            ->setParameter('lieu',$vols->getdestination())
            ->andWhere('v.tarif <= :prix')
            ->setParameter('prix', $vols->getTarif())
            // ->andWhere('v.depart <= :partir')
            // ->setParameter('partir', $vols->getDepart())
            // ->andWhere('v.datederetour = :back')
            // ->setParameter('back', $vols->getDatederetour())
            ->getQuery()
            ->getResult()
       ;
    }


//    public function findOneBySomeField($value): ?Vols
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
