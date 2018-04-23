<?php

declare(strict_types=1);

namespace CodelyTv\Test\Context\Video\Module\Review\Domain;

use CodelyTv\Context\Video\Module\Review\Domain\ReviewCreatedDomainEvent;
use CodelyTv\Context\Video\Module\Review\Domain\ReviewId;
use CodelyTv\Context\Video\Module\Review\Domain\ReviewRating;
use CodelyTv\Context\Video\Module\Review\Domain\ReviewText;
use CodelyTv\Context\Video\Module\Video\Domain\VideoId;

final class ReviewCreatedDomainEventStub
{
    public static function create(
        ReviewId $id,
        VideoId $videoId,
        ReviewRating $rating,
        ReviewText $text
    ): ReviewCreatedDomainEvent {
        return new ReviewCreatedDomainEvent(
            $id->value(),
            [
                'videoId' => $videoId->value(),
                'rating' => $rating->value(),
                'text' => (string) $text->value(),
            ]
        );
    }

    public static function random(): ReviewCreatedDomainEvent
    {
        return self::create(
            ReviewIdStub::random(),
            VideoIdStub::random(),
            ReviewRatingStub::random(),
            ReviewTextStub::random()
        );
    }
}
