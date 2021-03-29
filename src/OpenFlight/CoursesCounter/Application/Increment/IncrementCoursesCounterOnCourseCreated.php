<?php

declare(strict_types=1);

namespace CodelyTv\OpenFlight\CoursesCounter\Application\Increment;

use CodelyTv\OpenFlight\Courses\Domain\CourseCreatedDomainEvent;
use CodelyTv\OpenFlight\Shared\Domain\Courses\CourseId;
use CodelyTv\Shared\Domain\Bus\Event\DomainEventSubscriber;
use function Lambdish\Phunctional\apply;

final class IncrementCoursesCounterOnCourseCreated implements DomainEventSubscriber
{
    public function __construct(private CoursesCounterIncrementer $incrementer)
    {
    }

    public static function subscribedTo(): array
    {
        return [CourseCreatedDomainEvent::class];
    }

    public function __invoke(CourseCreatedDomainEvent $event): void
    {
        $courseId = new CourseId($event->aggregateId());

        apply($this->incrementer, [$courseId]);
    }
}
