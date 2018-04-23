<?php

declare(strict_types=1);

namespace CodelyTv\Context\Video\Module\Review\Domain;

use CodelyTv\Context\Video\Module\Video\Domain\VideoId;
use CodelyTv\Types\Aggregate\AggregateRoot;

final class Review extends AggregateRoot
{
    private $id;
    private $videoId;
    private $rating;
    private $text;
    private $url;

    public function __construct(ReviewId $id, VideoId $videoId, ReviewRating $rating, ReviewText $text)
    {
        $this->id = $id;
        $this->videoId = $videoId;
        $this->rating = $rating;
        $this->text = $text;
    }

    public static function create(
        ReviewId $id,
        VideoId $videoId,
        ReviewRating $rating,
        ReviewText $text
    ): Review {
        $review = new self($id, $videoId, $rating, $text);

        $review->record(
            new ReviewCreatedDomainEvent(
                $id->value(),
                [
                    'videoId' => $videoId->value(),
                    'rating' => $rating->value(),
                    'text' => (string) $text->value(),
                ]
            )
        );

        return $review;
    }

    public function id(): ReviewId
    {
        return $this->id;
    }

    public function videoId(): VideoId
    {
        return $this->videoId;
    }

    public function rating(): ReviewRating
    {
        return $this->rating;
    }

    public function text(): ReviewText
    {
        return $this->text;
    }
}
