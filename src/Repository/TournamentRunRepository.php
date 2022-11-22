<?php

namespace Floatingbits\EvolutionaryAlgorithmBundle\Repository;

use Floatingbits\EvolutionaryAlgorithmBundle\Entity\TournamentRun;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TournamentRun>
 *
 * @method TournamentRun|null find($id, $lockMode = null, $lockVersion = null)
 * @method TournamentRun|null findOneBy(array $criteria, array $orderBy = null)
 * @method TournamentRun[]    findAll()
 * @method TournamentRun[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TournamentRunRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TournamentRun::class);
    }

    public function save(TournamentRun $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(TournamentRun $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return TournamentRun[] Returns an array of TournamentType objects
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

//    public function findOneBySomeField($value): ?TournamentRun
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
