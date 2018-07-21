<?php

namespace CodelyTv\Context\Course\Module\Course\Application\Update;

use CodelyTv\Context\Course\Module\Course\Domain\CourseDescription;
use CodelyTv\Context\Course\Module\Course\Domain\CourseFinder;
use CodelyTv\Context\Course\Module\Course\Domain\CourseRepository;
use CodelyTv\Context\Course\Module\Course\Domain\CourseTitle;
use CodelyTv\Shared\Domain\Bus\Event\DomainEventPublisher;
use CodelyTv\Shared\Domain\CourseId;

final class CourseUpdater
{
    private $courseFinder;
    private $courseRepository;
    private $domainEventPublisher;

    public function __construct(CourseRepository $courseRepository, DomainEventPublisher $domainEventPublisher)
    {
        $this->courseFinder = new CourseFinder($courseRepository);
        $this->courseRepository = $courseRepository;
        $this->domainEventPublisher  = $domainEventPublisher;
    }

    public function update(CourseId $id, CourseTitle $title, CourseDescription $description): void
    {
        $course = $this->courseFinder->__invoke($id);

        $course->update($title, $description);

        $this->courseRepository->save($course);

        $this->domainEventPublisher->publish(...$course->pullDomainEvents());
    }
}
