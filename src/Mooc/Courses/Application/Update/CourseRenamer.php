<?php

declare(strict_types=1);

namespace CodelyTv\Mooc\Courses\Application\Update;

use CodelyTv\Mooc\Courses\Application\Find\CourseFinder;
use CodelyTv\Mooc\Courses\Domain\CourseName;
use CodelyTv\Mooc\Courses\Domain\CourseRepository;
use CodelyTv\Mooc\Shared\Domain\Courses\CourseId;
use CodelyTv\Shared\Domain\Bus\Event\EventBus;

final class CourseRenamer
{
    private readonly CourseFinder     $finder;

    public function __construct(private readonly CourseRepository $repository, private readonly EventBus $bus)
    {
        $this->finder = new CourseFinder($repository);
    }

    public function __invoke(CourseId $id, CourseName $newName): void
    {
        $course = $this->finder->__invoke($id);

        $course->rename($newName);

        $this->repository->save($course);
        $this->bus->publish(...$course->pullDomainEvents());
    }
}
