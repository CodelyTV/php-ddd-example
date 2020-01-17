<?php

declare(strict_types = 1);

namespace CodelyTv\Backoffice\Courses\Application\Create;

use CodelyTv\Mooc\Courses\Domain\CourseCreatedDomainEvent;
use CodelyTv\Shared\Domain\Bus\Event\DomainEventSubscriber;

final class CreateBackofficeCourseOnCourseCreated implements DomainEventSubscriber
{
    private $creator;

    public function __construct(BackofficeCourseCreator $creator)
    {
        $this->creator = $creator;
    }

    public static function subscribedTo(): array
    {
        return [CourseCreatedDomainEvent::class];
    }

    public function __invoke(CourseCreatedDomainEvent $event)
    {
        $this->creator->create($event->aggregateId(), $event->name(), $event->duration());
    }
}
