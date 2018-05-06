<?php

declare(strict_types=1);

namespace CodelyTv\Context\Course\Module\CourseOpinion\Infrastructure\Persistence\Repository;

use CodelyTv\Context\Course\Module\Course\Domain\Entity\Course;
use CodelyTv\Context\Course\Module\Course\Domain\ValueObject\CourseRating;
use CodelyTv\Context\Course\Module\CourseOpinion\Domain\Entity\CourseOpinion;
use CodelyTv\Context\Course\Module\CourseOpinion\Domain\Repository\CourseOpinionRepository;
use CodelyTv\Context\Course\Module\CourseOpinion\Domain\ValueObject\CourseOpinionId;
use CodelyTv\Infrastructure\Doctrine\Repository;
use Doctrine\ORM\NonUniqueResultException;

final class CourseOpinionRepositoryMySql extends Repository implements CourseOpinionRepository
{
    public function save(CourseOpinion $opinion): void
    {
        $this->persist($opinion);
    }

    public function findById(CourseOpinionId $id): ?CourseOpinion
    {
        return $this->repository(CourseOpinion::class)->find($id);
    }

    /**
     * @param Course $course
     *
     * @return CourseRating
     * @throws NonUniqueResultException
     */
    public function getRating(Course $course): CourseRating
    {
        $rating = $this->repository(CourseOpinion::class)->createQueryBuilder('o')
            ->select('AVG(o.rating.value)')
            ->where('o.courseId = :id')
            ->setParameter('id', $course->id())
            ->getQuery()
            ->getSingleScalarResult();

        return new CourseRating($rating);
    }
}
