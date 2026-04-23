<?php

namespace App\Repository;

use App\Entity\Task;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Folder;
use App\Entity\Priority;
use App\Entity\Status;

/**
 * @extends ServiceEntityRepository<Task>
 */
class TaskRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Task::class);
    }

    //    /**
    //     * @return Task[] Returns an array of Task objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('t')
    //            ->andWhere('t.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('t.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Task
    //    {
    //        return $this->createQueryBuilder('t')
    //            ->andWhere('t.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }


    public function findForHome(?Folder $folder, ?Status $status, ?Priority $priority): array
    {
    

        $qb = $this->createQueryBuilder('t')
            ->join('t.status', 's')
            ->leftJoin('t.priority', 'p')->addSelect('p')
            ->leftJoin('t.folder', 'f')->addSelect('f')
            ->addSelect('s');

        if ($folder !== null) {
            $qb->andWhere('t.folder = :folder')->setParameter('folder', $folder);
        }

        if ($status !== null) {
            $qb->andWhere('t.status = :status')->setParameter('status', $status);
        }

        if ($priority !== null) {
            $qb->andWhere('t.priority = :priority')->setParameter('priority', $priority);
        }

        // 0 = pinned (toujours en haut)
        // 1 = non terminé (si pas pinned)
        // 2 = terminé (si pas pinned)
        $qb->addSelect("
        CASE
            WHEN t.isPinned = true THEN 0
            WHEN s.name = :doneName THEN 2
            ELSE 1
        END AS HIDDEN sortBucket
    ")
            ->setParameter('doneName', 'Terminé')
            ->addOrderBy('sortBucket', 'ASC')
            ->addOrderBy('t.name', 'ASC')
            ->addOrderBy('t.id', 'ASC');

        return $qb->getQuery()->getResult();
    }
}
