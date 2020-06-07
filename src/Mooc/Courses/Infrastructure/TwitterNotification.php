<?php
declare(strict_types=1);

namespace CodelyTv\Mooc\Courses\Infrastructure;

final class TwitterNotification implements Notification
{
    private string $message;

    public function __construct(string $message)
    {
        $this->message = $message;
    }

    public function message(): string
    {
        return $this->message;
    }
}
