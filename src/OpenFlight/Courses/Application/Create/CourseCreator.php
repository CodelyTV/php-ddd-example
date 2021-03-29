<?php

declare(strict_types=1);

namespace CodelyTv\OpenFlight\Courses\Application\Create;

use CodelyTv\OpenFlight\Courses\Domain\Course;
use CodelyTv\OpenFlight\Courses\Domain\CourseDuration;
use CodelyTv\OpenFlight\Courses\Domain\CourseName;
use CodelyTv\OpenFlight\Courses\Domain\CourseRepository;
use CodelyTv\OpenFlight\Shared\Domain\Courses\CourseId;
use CodelyTv\Shared\Domain\Bus\Event\EventBus;

final class CourseCreator
{
    public function __construct(private CourseRepository $repository, private EventBus $bus)
    {
    }

    public function __invoke(CourseId $id, CourseName $name, CourseDuration $duration): void
    {
        $course = Course::create($id, $name, $duration);

        $this->repository->save($course);
        $this->bus->publish(...$course->pullDomainEvents());
    }
}
