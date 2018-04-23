<?php

declare(strict_types=1);

namespace CodelyTv\Test\Context\Video\Module\Review\Domain;

use CodelyTv\Context\Video\Module\Review\Domain\Review;
use CodelyTv\Context\Video\Module\Review\Domain\ReviewId;
use CodelyTv\Context\Video\Module\Review\Domain\ReviewRating;
use CodelyTv\Context\Video\Module\Review\Domain\ReviewText;
use CodelyTv\Context\Video\Module\Video\Domain\VideoId;
use CodelyTv\Test\Context\Video\Module\Video\Domain\VideoIdStub;

final class ReviewStub
{
    public static function withId(ReviewId $id)
    {
        return self::create(
            $id,
            VideoIdStub::random(),
            ReviewRatingStub::random(),
            ReviewTextStub::random()
        );
    }

    public static function create(ReviewId $id, VideoId $videoId, ReviewRating $rating, ReviewText $text)
    {
        return new Review($id, $videoId, $rating, $text);
    }

    public static function random(): Review
    {
        return self::create(
            ReviewIdStub::random(),
            VideoIdStub::random(),
            ReviewRatingStub::random(),
            ReviewTextStub::random()
        );
    }
}
