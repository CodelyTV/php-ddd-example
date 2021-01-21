<?php
declare(strict_types=1);

namespace CodelyTv\Shared\Domain\ValueObject;

class DateTimeValueObject extends \DateTimeImmutable
{
    public function __construct(protected \DateTimeImmutable $value)
    {
        parent::__construct();
    }

    final public static function from(string $str): self
    {
        return new static($str, new \DateTimeZone('UTC'));
    }

    public function value(): string
    {
        return $this->format(DATE_ATOM);
    }
}
