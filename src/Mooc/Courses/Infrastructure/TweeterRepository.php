<?php

declare(strict_types=1);

namespace CodelyTv\Mooc\Courses\Domain\CourseNotifier;

use CodelyTv\Mooc\Courses\Domain\Course;

class TweeterRepository implements CourseNotifier
{
    public function publish(String $message, String $title = null): string
    {
       var_dump($message);
    }

}

