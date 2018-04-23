<?php
declare(strict_types=1);

namespace CodelyTv\Context\Video\Module\Review\Domain;

final class ReviewRating
{
    const MIN_RATING = 0;
    const MAX_RATING = 5;

    private $value;

    public function __construct(int $value)
    {
        $this->guard($value);

        $this->value = $value;
    }

    public function value(): int
    {
        return $this->value;
    }

    private function guard(int $value)
    {
        if ($value < self::MIN_RATING || $value > self::MAX_RATING) {
            throw new \InvalidArgumentException(
                sprintf(
                    'The rating must be between %d and %d, %d received',
                    self::MIN_RATING,
                    self::MAX_RATING,
                    $value
                )
            );
        }
    }
}
