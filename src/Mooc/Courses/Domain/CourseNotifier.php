<?php

declare(strict_types=1);

namespace CodelyTv\Mooc\Courses\Domain;

interface CourseNotifier
{
    public function publish(String $message, String $title = null): void;

}
