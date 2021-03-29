<?php

declare(strict_types=1);

namespace CodelyTv\OpenFlight\Courses\Application\Update;

use CodelyTv\OpenFlight\Courses\Application\Find\CourseFinder;
use CodelyTv\OpenFlight\Courses\Domain\CourseName;
use CodelyTv\OpenFlight\Courses\Domain\CourseRepository;
use CodelyTv\OpenFlight\Shared\Domain\Courses\CourseId;
use CodelyTv\Shared\Domain\Bus\Event\EventBus;

final class CourseRenamer
{
    private CourseFinder     $finder;

    public function __construct(private CourseRepository $repository, private EventBus $bus)
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
