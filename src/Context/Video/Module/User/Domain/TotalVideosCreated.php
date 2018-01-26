<?php

declare(strict_types = 1);

namespace CodelyTv\Context\Video\Module\User\Domain;

use CodelyTv\Types\ValueObject\IntValueObject;

final class TotalVideosCreated extends IntValueObject
{
    public function increase(): self
    {
        return new self($this->value() + 1);
    }
}
