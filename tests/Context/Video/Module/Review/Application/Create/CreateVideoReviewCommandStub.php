<?php
declare(strict_types=1);

namespace CodelyTv\Test\Context\Video\Module\Review\Application\Create;

use CodelyTv\Context\Video\Module\Review\Application\Create\CreateVideoReviewCommand;
use CodelyTv\Context\Video\Module\Review\Domain\ReviewId;
use CodelyTv\Context\Video\Module\Review\Domain\ReviewRating;
use CodelyTv\Context\Video\Module\Review\Domain\ReviewText;
use CodelyTv\Context\Video\Module\Video\Domain\VideoId;
use CodelyTv\Test\Context\Video\Module\Review\Domain\ReviewIdStub;
use CodelyTv\Test\Context\Video\Module\Review\Domain\ReviewRatingStub;
use CodelyTv\Test\Context\Video\Module\Review\Domain\ReviewTextStub;
use CodelyTv\Test\Context\Video\Module\Video\Domain\VideoIdStub;
use CodelyTv\Test\Shared\Domain\UuidStub;
use CodelyTv\Types\ValueObject\Uuid;

final class CreateVideoReviewCommandStub
{
    public static function create(
        Uuid $requestId,
        ReviewId $id,
        VideoId $videoId,
        ReviewRating $rating,
        ReviewText $text
    ): CreateVideoReviewCommand {
        return new CreateVideoReviewCommand(
            $requestId,
            $id->value(),
            $videoId->value(),
            $rating->value(),
            $text->value()
        );
    }

    public static function random(): CreateVideoReviewCommand
    {
        return self::create(
            new Uuid(UuidStub::random()),
            ReviewIdStub::random(),
            VideoIdStub::random(),
            ReviewRatingStub::random(),
            ReviewTextStub::random()
        );
    }

    public function withText(ReviewText $text)
    {
        return self::create(
            new Uuid(UuidStub::random()),
            ReviewIdStub::random(),
            VideoIdStub::random(),
            ReviewRatingStub::random(),
            $text
        );
    }
}
