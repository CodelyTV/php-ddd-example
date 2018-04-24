<?php

namespace CodelyTv\Context\Video\Module\Review\Domain;

final class ReviewText
{
    const MAX_LENGTH = 300;

    private $value;

    public function __construct(?string $value)
    {
        $this->guard($value);

        $this->value = $value;
    }

    public function value(): ?string
    {
        return $this->value;
    }

    private function guard(?string $value)
    {
        $len = strlen($value);
        if ($len > self::MAX_LENGTH) {
            throw new \InvalidArgumentException(
                sprintf(
                    'The text must not be longer than %d, %d characters received',
                    self::MAX_LENGTH,
                    $len
                )
            );
        }
    }

    public function empty()
    {
        return is_null($this->value()) || strlen(trim($this->value())) === 0;
    }
}
