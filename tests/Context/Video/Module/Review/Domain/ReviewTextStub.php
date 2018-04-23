<?php

declare(strict_types=1);

namespace CodelyTv\Test\Context\Video\Module\Review\Domain;

use CodelyTv\Context\Video\Module\Review\Domain\ReviewText;
use CodelyTv\Test\Shared\Domain\StubCreator;

final class ReviewTextStub
{
    public static function create(?string $text): ReviewText
    {
        return new ReviewText($text);
    }

    public static function random(): ReviewText
    {
        return self::create(StubCreator::random()->optional()->paragraph);
    }
}
