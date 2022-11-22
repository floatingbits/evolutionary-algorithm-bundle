<?php

namespace Floatingbits\EvolutionaryAlgorithmBundle\Repository;

use Floatingbits\EvolutionaryAlgorithmBundle\Entity\TournamentConfiguration;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TournamentConfiguration>
 *
 * @method TournamentConfiguration|null find($id, $lockMode = null, $lockVersion = null)
 * @method TournamentConfiguration|null findOneBy(array $criteria, array $orderBy = null)
 * @method TournamentConfiguration[]    findAll()
 * @method TournamentConfiguration[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TournamentConfigurationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TournamentConfiguration::class);
    }

    public function save(TournamentConfiguration $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(TournamentConfiguration $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return TournamentConfiguration[] Returns an array of TournamentType objects
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

//    public function findOneBySomeField($value): ?TournamentConfiguration
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
