<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\Courses\Application\Create;

use CodelyTv\Mooc\Courses\Domain\Course;
use CodelyTv\Mooc\Courses\Domain\CourseDuration;
use CodelyTv\Mooc\Courses\Domain\CourseName;
use CodelyTv\Mooc\Courses\Domain\CourseRepository;
use CodelyTv\Mooc\Shared\Domain\Course\CourseId;
use CodelyTv\Mooc\Shared\Domain\Logger;
use CodelyTv\Shared\Domain\Bus\Event\EventBus;

use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;

final class CourseCreator implements LoggerAwareInterface
{
    private CourseRepository $repository;
    private EventBus         $bus;
    private ?LoggerInterface  $logger;

    public function __construct(CourseRepository $repository, EventBus $bus)
    {
        $this->repository = $repository;
        $this->bus        = $bus;
        $this->logger     = null;
    }

    public function __invoke(CourseId $id, CourseName $name, CourseDuration $duration): void
    {
        $course = Course::create($id, $name, $duration);

        $this->repository->save($course);
        $this->bus->publish(...$course->pullDomainEvents());
        if($this->hasLogger())
        {
            $message = sprintf("Course named %s with id %s has been created", $name, $id);
            $this->logger->log(LogLevel::INFO, $message);
        }

    }

    public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    private function hasLogger()
    {
        return ! is_null($this->logger);
    }
}
