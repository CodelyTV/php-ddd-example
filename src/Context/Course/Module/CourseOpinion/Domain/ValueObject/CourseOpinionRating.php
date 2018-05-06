<?php

declare(strict_types=1);

namespace CodelyTv\Context\Course\Module\CourseOpinion\Domain\ValueObject;

final class CourseOpinionRating
{
    private const MAX_RATING = 5;
    private const MIN_RATING = 0;

    private $value;

    /**
     * @param mixed $value
     *
     * @throws \Exception
     */
    public function __construct($value)
    {
        $this->guard($value);

        $this->value = $value;
    }

    /**
     * @param mixed $value
     *
     * @throws \Exception
     */
    private function guard($value): void
    {
        if (\is_float($value)) {
            throw new \InvalidArgumentException(
                sprintf('The rating cannot be a decimal, %f received', $value)
            );
        }

        if ($value > 5) {
            throw new \InvalidArgumentException(
                sprintf('The maximum rating for an opinion is %d, %d received', self::MAX_RATING, $value)
            );
        }

        if ($value < 0) {
            throw new \InvalidArgumentException(
                sprintf('The minimum rating for an opinion is %d, %d received', self::MIN_RATING, $value)
            );
        }
    }

    public function value(): int
    {
        return $this->value;
    }
}
