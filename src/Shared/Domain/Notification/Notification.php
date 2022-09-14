<?php

declare(strict_types=1);

namespace CodelyTv\Shared\Domain\Notification;

final class Notification
{
    public function __construct(private readonly string $text) {}

    public function getText(): string {
        return $this->text;
    }
}
