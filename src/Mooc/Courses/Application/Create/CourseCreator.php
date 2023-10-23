<?php

declare(strict_types=1);

namespace CodelyTv\Mooc\Courses\Application\Create;

use CodelyTv\Mooc\Courses\Domain\Course;
use CodelyTv\Mooc\Courses\Domain\CourseDuration;
use CodelyTv\Mooc\Courses\Domain\CourseName;
use CodelyTv\Mooc\Courses\Domain\CourseRepository;
use CodelyTv\Mooc\Shared\Domain\Courses\CourseId;
use CodelyTv\Shared\Domain\Bus\Event\EventBus;

final readonly class CourseCreator
{
	public function __construct(private CourseRepository $repository, private EventBus $bus) {}

	public function __invoke(CourseId $id, CourseName $name, CourseDuration $duration): void
	{
		$course = Course::create($id, $name, $duration);

		$this->repository->save($course);
		$this->bus->publish(...$course->pullDomainEvents());
	}
}
