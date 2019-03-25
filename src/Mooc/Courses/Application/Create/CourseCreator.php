<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\Courses\Application\Create;

use CodelyTv\Mooc\Courses\Domain\Course;
use CodelyTv\Mooc\Courses\Domain\CourseDescription;
use CodelyTv\Mooc\Courses\Domain\CourseRepository;
use CodelyTv\Mooc\Courses\Domain\CourseTitle;
use CodelyTv\Mooc\Shared\Domain\Courses\CourseId;
use CodelyTv\Shared\Domain\Bus\Event\DomainEventPublisher;

final class CourseCreator
{
    private $repository;
    private $publisher;

    public function __construct(CourseRepository $repository, DomainEventPublisher $publisher)
    {
        $this->repository = $repository;
        $this->publisher  = $publisher;
    }

    public function create(CourseId $id, CourseTitle $title, CourseDescription $description): void
    {
        $course = Course::create($id, $title, $description);

        $this->repository->save($course);

        $this->publisher->publish(...$course->pullDomainEvents());
    }
}
