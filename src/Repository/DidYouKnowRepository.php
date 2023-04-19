<?php

namespace App\Repository;

use App\Entity\DidYouKnow;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<DidYouKnow>
 *
 * @method DidYouKnow|null find($id, $lockMode = null, $lockVersion = null)
 * @method DidYouKnow|null findOneBy(array $criteria, array $orderBy = null)
 * @method DidYouKnow[]    findAll()
 * @method DidYouKnow[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DidYouKnowRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DidYouKnow::class);
    }

    public function save(DidYouKnow $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(DidYouKnow $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return DidYouKnow[] Returns an array of DidYouKnow objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('d.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?DidYouKnow
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
