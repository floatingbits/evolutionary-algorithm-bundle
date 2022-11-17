<?php

namespace Floatingbits\EvolutionaryAlgorithmBundle\Repository;

use Floatingbits\EvolutionaryAlgorithmBundle\Entity\ProblemInstance;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ProblemInstance>
 *
 * @method ProblemInstance|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProblemInstance|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProblemInstance[]    findAll()
 * @method ProblemInstance[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProblemInstanceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProblemInstance::class);
    }

    public function save(ProblemInstance $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(ProblemInstance $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return ProblemInstance[] Returns an array of ProblemInstance objects
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

//    public function findOneBySomeField($value): ?ProblemInstance
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
