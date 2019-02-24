<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\Student\Domain;

use CodelyTv\Shared\Domain\ValueObject\IntValueObject;

final class StudentTotalVideosCreated extends IntValueObject
{
    public function increase(): self
    {
        return new self($this->value() + 1);
    }
}
