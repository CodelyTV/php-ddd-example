<?php
declare(strict_types=1);

namespace CodelyTv\Mooc\Courses\Infrastructure;

interface Notification
{
    public function message(): string;
}