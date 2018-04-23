<?php

declare(strict_types=1);

namespace CodelyTv\Context\Video\Module\Review\Application\Create;

use CodelyTv\Context\Video\Module\Review\Domain\ReviewId;
use CodelyTv\Context\Video\Module\Review\Domain\ReviewRating;
use CodelyTv\Context\Video\Module\Review\Domain\ReviewText;
use CodelyTv\Context\Video\Module\Video\Domain\VideoId;

final class CreateVideoReviewCommandHandler
{
    private $creator;

    public function __construct(ReviewCreator $creator)
    {
        $this->creator = $creator;
    }

    public function __invoke(CreateVideoReviewCommand $command)
    {
        $id = new ReviewId($command->id());
        $videoId = new VideoId($command->videoId());
        $rating = new ReviewRating($command->rating());
        $text = new ReviewText($command->text());

        $this->creator->create($id, $videoId, $rating, $text);
    }
}
