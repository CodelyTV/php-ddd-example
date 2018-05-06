<?php

declare(strict_types=1);

namespace CodelyTv\Context\Course\Module\CourseOpinion\Domain\ValueObject;

final class NotificationText
{
    private $value;

    public function __construct(string $value)
    {
        $this->value = $value;
    }

    public function value(): string
    {
        return $this->value;
    }
}
