<?php

declare(strict_types=1);

namespace CodelyTv\Backoffice\Courses\Application\Create;

use CodelyTv\Backoffice\Courses\Domain\BackofficeCourse;
use CodelyTv\Backoffice\Courses\Domain\BackofficeCourseRepository;
use CodelyTv\Mooc\Courses\Domain\CourseDuration;
use CodelyTv\Mooc\Courses\Domain\CourseName;
use CodelyTv\Mooc\Shared\Domain\Courses\CourseId;

final class BackofficeCourseCreator
{
    public function __construct(private readonly BackofficeCourseRepository $repository)
    {
    }

    public function create(CourseId $id, CourseName $name, CourseDuration $duration): void
    {
        $this->repository->save(BackofficeCourse::create($id, $name, $duration));
    }
}
