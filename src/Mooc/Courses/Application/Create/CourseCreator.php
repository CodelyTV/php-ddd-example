<?php

declare(strict_types=1);

namespace CodelyTv\Mooc\Courses\Application\Create;

use CodelyTv\Mooc\Courses\Domain\Course;
use CodelyTv\Mooc\Courses\Domain\CourseDuration;
use CodelyTv\Mooc\Courses\Domain\CourseGenerationNotificator;
use CodelyTv\Mooc\Courses\Domain\CourseName;
use CodelyTv\Mooc\Courses\Domain\CourseRepository;
use CodelyTv\Mooc\Courses\Infrastructure\Symfony\Mailer\SwiftCourseGenerationNotificator;
use CodelyTv\Mooc\Shared\Domain\Course\CourseId;
use CodelyTv\Shared\Domain\Bus\Event\EventBus;

final class CourseCreator
{
    private $repository;
    private $bus;
    private $courseNotificator;

    public function __construct(CourseRepository $repository, EventBus $bus, CourseGenerationNotificator $courseNotificator)
    {
        $this->repository = $repository;
        $this->bus        = $bus;
        $this->courseNotificator = $courseNotificator;
    }

    public function __invoke(CourseId $id, CourseName $name, CourseDuration $duration)
    {
        $course = Course::create($id, $name, $duration);
        $this->repository->save($course);
        $this->bus->publish(...$course->pullDomainEvents());
        $this->courseNotificator->notifyCourseCreated($course);
    }
}
