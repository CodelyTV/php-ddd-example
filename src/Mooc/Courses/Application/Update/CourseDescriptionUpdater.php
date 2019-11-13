<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\Courses\Application\Update;

use CodelyTv\Mooc\Courses\Domain\CourseDescription;
use CodelyTv\Mooc\Courses\Domain\CourseFinder;
use CodelyTv\Mooc\Courses\Domain\CourseRepository;
use CodelyTv\Mooc\Shared\Domain\Courses\CourseId;

final class CourseDescriptionUpdater
{
    private $repository;
    private $finder;

    public function __construct(CourseRepository $repository)
    {
        $this->finder = new CourseFinder($repository);
        $this->repository = $repository;
    }

    public function __invoke(CourseId $id, CourseDescription $newDescription)
    {
        $course = $this->finder->__invoke($id);

        $course->updateDescription($newDescription);

        $this->repository->save($course);
    }
}