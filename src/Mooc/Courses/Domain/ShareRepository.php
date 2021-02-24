<?php

declare(strict_types=1);

namespace CodelyTv\Mooc\Courses\Domain;

interface ShareRepository
{
    public function share(Course $course): void;
}
