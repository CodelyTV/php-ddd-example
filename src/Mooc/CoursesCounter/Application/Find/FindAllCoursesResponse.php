<?php
declare(strict_types=1);

namespace CodelyTv\Mooc\CoursesCounter\Application\Find;

use CodelyTv\Shared\Domain\Bus\Query\Response;

final class FindAllCoursesResponse implements Response
{
    private array $courses;

    public function __construct(array $courses)
    {
        $this->courses = $courses;
    }

    public function courses(): array
    {
        return $this->courses;
    }
}