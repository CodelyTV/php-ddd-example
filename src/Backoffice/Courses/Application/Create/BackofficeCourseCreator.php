<?php

declare(strict_types=1);

namespace CodelyTv\Backoffice\Courses\Application\Create;

use CodelyTv\Backoffice\Courses\Domain\BackofficeCourse;
use CodelyTv\Backoffice\Courses\Domain\BackofficeCourseRepository;

final class BackofficeCourseCreator
{
    public function __construct(private readonly BackofficeCourseRepository $repository)
    {
    }

    public function create(string $id, string $name, string $duration): void
    {
        $this->repository->save(new BackofficeCourse($id, $name, $duration));
    }
}
