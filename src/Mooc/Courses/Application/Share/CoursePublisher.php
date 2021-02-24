<?php

declare(strict_types=1);

namespace CodelyTv\Mooc\Courses\Application\Share;

use CodelyTv\Mooc\Courses\Domain\Course;
use CodelyTv\Mooc\Courses\Domain\ShareRepository;

final class CoursePublisher
{
    public function __construct(private ShareRepository $repository)
    {
    }

    public function __invoke(Course $course): void
    {
        $this->repository->share($course);
    }
}
