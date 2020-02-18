<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\CoursesCounter\Application\Increment;

use CodelyTv\Mooc\CoursesCounter\Domain\CoursesCounterInitializer;
use CodelyTv\Mooc\CoursesCounter\Domain\CoursesCounterRepository;
use CodelyTv\Mooc\Shared\Domain\Course\CourseId;
use CodelyTv\Shared\Domain\Bus\Event\EventBus;
use function Lambdish\Phunctional\apply;

final class CoursesCounterIncrementer
{
    private $repository;
    private $coursesCounterInitializer;
    private $bus;

    public function __construct(
        CoursesCounterRepository $repository,
        CoursesCounterInitializer $coursesCounterInitializer,
        EventBus $bus
    ) {
        $this->repository    = $repository;
        $this->coursesCounterInitializer = $coursesCounterInitializer;
        $this->bus           = $bus;
    }

    public function __invoke(CourseId $courseId)
    {
        $counter = $this->repository->search() ?: apply($this->coursesCounterInitializer);

        if (!$counter->hasIncremented($courseId)) {
            $counter->increment($courseId);

            $this->repository->save($counter);
            $this->bus->publish(...$counter->pullDomainEvents());
        }
    }
}
