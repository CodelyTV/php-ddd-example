<?php

declare(strict_types=1);

namespace CodelyTv\Context\Course\Module\Course\Application\Create;

use CodelyTv\Context\Course\Module\Course\Domain\Entity\Course;
use CodelyTv\Context\Course\Module\Course\Domain\Repository\CourseRepository;
use CodelyTv\Context\Course\Module\Course\Domain\ValueObject\CourseDescription;
use CodelyTv\Context\Course\Module\Course\Domain\ValueObject\CourseTitle;
use CodelyTv\Shared\Domain\Bus\Event\DomainEventPublisher;
use CodelyTv\Shared\Domain\CourseId;

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
