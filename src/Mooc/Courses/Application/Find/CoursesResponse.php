<?php

declare(strict_types=1);

namespace CodelyTv\Mooc\Courses\Application\Find;

use CodelyTv\Shared\Domain\Bus\Query\Response;

final class CoursesResponse implements Response
{
    /** @var array */
    private $courses;

    /**
     * CoursesResponse constructor
     */
    public function __construct(array $courses)
    {
        $this->courses = $courses;
    }

    public function courses(): array
    {
        return $this->courses;
    }
}