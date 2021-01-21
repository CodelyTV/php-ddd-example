<?php
declare(strict_types=1);

namespace CodelyTv\Shared\Domain\ValueObject;

class DateTimeValueObject extends \DateTime
{
    public function __construct(protected \DateTimeImmutable $value)
    {
        parent::__construct();
    }

    public function value(): string
    {
        return $this->format(\DATE_ATOM);
    }
}
