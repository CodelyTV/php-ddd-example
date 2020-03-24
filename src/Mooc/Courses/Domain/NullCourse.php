<?php

declare(strict_types=1);

namespace CodelyTv\Mooc\Courses\Domain;


final class NullCourse implements CouserEntity
{
    public function __call($name, $arguments)
    {
        // TODO: Implement __call() method.
    }
}
