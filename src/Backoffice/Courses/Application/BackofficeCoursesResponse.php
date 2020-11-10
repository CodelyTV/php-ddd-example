<?php

declare(strict_types=1);

namespace CodelyTv\Backoffice\Courses\Application;

use CodelyTv\Shared\Domain\Bus\Query\Response;

final class BackofficeCoursesResponse implements Response
{
    public function __construct(private BackofficeCourseResponse ...$courses)
    {
    }

    public function courses(): array
    {
        return $this->courses;
    }
}
