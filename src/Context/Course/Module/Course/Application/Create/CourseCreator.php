<?php

namespace CodelyTv\Context\Course\Module\Course\Application\Create;

use CodelyTv\Context\Course\Module\Course\Domain\Course;
use CodelyTv\Context\Course\Module\Course\Domain\CourseDescription;
use CodelyTv\Context\Course\Module\Course\Domain\CourseRepository;
use CodelyTv\Context\Course\Module\Course\Domain\CourseTitle;
use CodelyTv\Shared\Domain\Bus\Event\DomainEventPublisher;
use CodelyTv\Shared\Domain\CourseId;

/**
 * CourseCreator
 */
final class CourseCreator
{
    /**
     * @var CourseRepository
     */
    private $repository;
    /**
     * @var DomainEventPublisher
     */
    private $publisher;

    /**
     * CourseCreator constructor.
     *
     * @param CourseRepository $repository
     * @param DomainEventPublisher $publisher
     */
    public function __construct(CourseRepository $repository, DomainEventPublisher $publisher)
    {

        $this->repository = $repository;
        $this->publisher = $publisher;
    }

    public function create(CourseId $id, CourseTitle $title, CourseDescription $description)
    {
        $course = Course::create($id, $title, $description);

        $this->repository->save($course);

        $this->publisher->publish(...$course->pullDomainEvents());
    }
}