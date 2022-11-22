<?php

namespace Floatingbits\EvolutionaryAlgorithmBundle\Repository;

use Floatingbits\EvolutionaryAlgorithmBundle\Entity\TournamentType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TournamentType>
 *
 * @method TournamentType|null find($id, $lockMode = null, $lockVersion = null)
 * @method TournamentType|null findOneBy(array $criteria, array $orderBy = null)
 * @method TournamentType[]    findAll()
 * @method TournamentType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TournamentTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TournamentType::class);
    }

    public function save(TournamentType $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(TournamentType $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return TournamentType[] Returns an array of TournamentType objects
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

//    public function findOneBySomeField($value): ?TournamentType
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
