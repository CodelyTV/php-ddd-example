<?php

declare(strict_types=1);

namespace CodelyTv\Backoffice\Courses\Application\Create;

use CodelyTv\Mooc\Courses\Domain\CourseCreatedDomainEvent;
use CodelyTv\Shared\Domain\Bus\Event\DomainEventSubscriber;

final class CreateBackofficeCourseOnCourseCreated implements DomainEventSubscriber
{
    public function __construct(private readonly BackofficeCourseCreator $creator)
    {
    }

    public static function subscribedTo(): array
    {
        return [CourseCreatedDomainEvent::class];
    }

    public function __invoke(CourseCreatedDomainEvent $event): void
    {
        $this->creator->create($event->aggregateId(), $event->name(), $event->duration());
    }
}
