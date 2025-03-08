<?php

namespace App\Repository;

use App\Entity\Course;
use App\Entity\CourseBlock;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class CourseBlockRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CourseBlock::class);
    }

    /**
     * Récupère le nombre maximal de pages pour un cours donné.
     */
    public function getMaxPageNumber(Course $course): int
    {
        return (int) $this->createQueryBuilder('cb')
            ->select('MAX(cb.page_number) as max_page')
            ->where('cb.course = :course')
            ->setParameter('course', $course)
            ->getQuery()
            ->getSingleScalarResult();
    }

    /**
     * Récupère tous les blocs de contenu pour une page donnée et un cours donné.
     */
    public function getBlocksByPage(Course $course, int $page): array
    {
        return $this->createQueryBuilder('cb')
            ->where('cb.course = :course')
            ->andWhere('cb.page_number = :page')
            ->setParameter('course', $course)
            ->setParameter('page', $page)
            ->orderBy('cb.id', 'ASC')
            ->getQuery()
            ->getResult();
    }
}
