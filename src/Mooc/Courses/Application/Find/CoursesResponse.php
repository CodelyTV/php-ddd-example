<?php

declare(strict_types=1);


namespace CodelyTv\Mooc\Courses\Application\Find;


use CodelyTv\Shared\Domain\Bus\Query\Response;

final class CoursesResponse implements Response
{
    public function __construct(
        private array $course
    )
    {
    }

    public function getCourse(): array
    {
        return $this->course;
    }


}
