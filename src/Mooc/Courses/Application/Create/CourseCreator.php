<?php

declare(strict_types=1);

namespace CodelyTv\Mooc\Courses\Application\Create;

use CodelyTv\Mooc\Courses\Domain\Course;
use CodelyTv\Mooc\Courses\Domain\CourseDuration;
use CodelyTv\Mooc\Courses\Domain\CourseName;
use CodelyTv\Mooc\Courses\Domain\CourseRepository;
use CodelyTv\Mooc\Courses\Domain\CourseDuplicated;
use CodelyTv\Mooc\Shared\Domain\Course\CourseId;
use CodelyTv\Shared\Domain\Bus\Event\EventBus;


final class CourseCreator
{
    private CourseRepository $repository;
    private EventBus         $bus;

    public function __construct(CourseRepository $repository, EventBus $bus)
    {
        $this->repository = $repository;
        $this->bus        = $bus;
    }

    public function __invoke(CourseId $id, CourseName $name, CourseDuration $duration)
    {
        $course = Course::create($id, $name, $duration);
        $courseFound = $this->repository->search($id);
        if(null === $courseFound)
        {
            $this->repository->save($course);
            $this->bus->publish(...$course->pullDomainEvents());
            
        }else{
            throw new CourseDuplicated($id);
        }

    }
}
