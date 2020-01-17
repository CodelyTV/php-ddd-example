<?php

declare(strict_types = 1);

namespace CodelyTv\Backoffice\Courses\Infrastructure\Persistence;

use CodelyTv\Backoffice\Courses\Domain\BackofficeCourse;
use CodelyTv\Backoffice\Courses\Domain\BackofficeCourseRepository;
use CodelyTv\Shared\Domain\Criteria\Criteria;
use function Lambdish\Phunctional\get;

final class InMemoryCacheBackofficeCourseRepository implements BackofficeCourseRepository
{
    private static $allCoursesCache = [];
    private static $matchingCache = [];
    private $repository;

    public function __construct(BackofficeCourseRepository $repository)
    {
        $this->repository = $repository;
    }

    public function save(BackofficeCourse $course): void
    {
        $this->repository->save($course);
    }

    public function searchAll(): array
    {
        return empty(self::$allCoursesCache) ? $this->searchAllAndFillCache() : self::$allCoursesCache;
    }

    public function matching(Criteria $criteria): array
    {
        return get($criteria->serialize(), self::$matchingCache) ?: $this->searchMatchingAndFillCache($criteria);
    }

    private function searchAllAndFillCache(): array
    {
        return self::$allCoursesCache = $this->repository->searchAll();
    }

    private function searchMatchingAndFillCache(Criteria $criteria): array
    {
        return self::$matchingCache[$criteria->serialize()] = $this->repository->matching($criteria);
    }
}
