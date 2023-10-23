<?php

declare(strict_types=1);

namespace CodelyTv\Mooc\CoursesCounter\Application\Increment;

use CodelyTv\Mooc\CoursesCounter\Domain\CoursesCounter;
use CodelyTv\Mooc\CoursesCounter\Domain\CoursesCounterId;
use CodelyTv\Mooc\CoursesCounter\Domain\CoursesCounterRepository;
use CodelyTv\Mooc\Shared\Domain\Courses\CourseId;
use CodelyTv\Shared\Domain\Bus\Event\EventBus;
use CodelyTv\Shared\Domain\UuidGenerator;

final readonly class CoursesCounterIncrementer
{
	public function __construct(
		private CoursesCounterRepository $repository,
		private UuidGenerator $uuidGenerator,
		private EventBus $bus
	) {}

	public function __invoke(CourseId $courseId): void
	{
		$counter = $this->repository->search() ?: $this->initializeCounter();

		if (!$counter->hasIncremented($courseId)) {
			$counter->increment($courseId);

			$this->repository->save($counter);
			$this->bus->publish(...$counter->pullDomainEvents());
		}
	}

	private function initializeCounter(): CoursesCounter
	{
		return CoursesCounter::initialize(new CoursesCounterId($this->uuidGenerator->generate()));
	}
}
