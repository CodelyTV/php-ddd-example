<?php

declare(strict_types = 1);

namespace CodelyTv\Backoffice\Courses\Application\SearchAll;

use CodelyTv\Backoffice\Courses\Application\BackofficeCourseResponse;
use CodelyTv\Backoffice\Courses\Application\BackofficeCoursesResponse;
use CodelyTv\Backoffice\Courses\Domain\BackofficeCourse;
use CodelyTv\Backoffice\Courses\Domain\BackofficeCourseRepository;
use function Lambdish\Phunctional\map;

final class AllBackofficeCoursesSearcher
{
    private $repository;

    public function __construct(BackofficeCourseRepository $repository)
    {
        $this->repository = $repository;
    }

    public function searchAll(): BackofficeCoursesResponse
    {
        return new BackofficeCoursesResponse(...map($this->toResponse(), $this->repository->searchAll()));
    }

    private function toResponse(): callable
    {
        return static function (BackofficeCourse $course) {
            return new BackofficeCourseResponse($course->id(), $course->name(), $course->duration());
        };
    }
}
