<?php

declare(strict_types=1);

namespace CodelyTv\Mooc\Courses\Domain;


use CodelyTv\Mooc\Shared\Domain\Course\CourseId;

final class NullCourse implements CouserEntity
{
    private CourseId $id;

    public function __construct(CourseId $id)
    {
        $this->id = $id;
    }

    public function __call($name, $arguments)
    {
        throw new CourseNotExist($this->id);
    }
}
