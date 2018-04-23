<?php

declare(strict_types=1);

namespace CodelyTv\Test\Context\Video\Module\Review\Domain;

use CodelyTv\Context\Video\Module\Review\Domain\ReviewRating;
use CodelyTv\Test\Shared\Domain\StubCreator;

final class ReviewRatingStub
{
    public static function create(int $rating): ReviewRating
    {
        return new ReviewRating($rating);
    }

    public static function random(): ReviewRating
    {
        return self::create(StubCreator::random()->numberBetween(0, 5));
    }
}
