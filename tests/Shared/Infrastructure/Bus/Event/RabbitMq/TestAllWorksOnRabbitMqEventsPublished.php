<?php

declare(strict_types=1);

namespace CodelyTv\Tests\Shared\Infrastructure\Bus\Event\RabbitMq;

use CodelyTv\Mooc\Courses\Domain\CourseCreatedDomainEvent;
use CodelyTv\Mooc\CoursesCounter\Domain\CoursesCounterIncrementedDomainEvent;
use CodelyTv\Shared\Domain\Bus\Event\DomainEventSubscriber;

final class TestAllWorksOnRabbitMqEventsPublished implements DomainEventSubscriber
{
	public static function subscribedTo(): array
	{
		return [CourseCreatedDomainEvent::class, CoursesCounterIncrementedDomainEvent::class, ];
	}

	public function __invoke(CourseCreatedDomainEvent | CoursesCounterIncrementedDomainEvent $event): void {}
}
