<?php

declare(strict_types=1);

namespace CodelyTv\Context\Video\Module\Review\Application\Create;

use CodelyTv\Context\Video\Module\Review\Domain\Review;
use CodelyTv\Context\Video\Module\Review\Domain\ReviewId;
use CodelyTv\Context\Video\Module\Review\Domain\ReviewRating;
use CodelyTv\Context\Video\Module\Review\Domain\ReviewRepository;
use CodelyTv\Context\Video\Module\Review\Domain\ReviewText;
use CodelyTv\Context\Video\Module\Video\Domain\VideoId;
use CodelyTv\Shared\Domain\Bus\Event\DomainEventPublisher;

final class ReviewCreator
{
    private $repository;
    private $publisher;

    public function __construct(ReviewRepository $repository, DomainEventPublisher $publisher)
    {
        $this->repository = $repository;
        $this->publisher  = $publisher;
    }

    public function create(ReviewId $id, VideoId $videoId, ReviewRating $rating, ReviewText $text)
    {
        $review = Review::create($id, $videoId, $rating, $text);

        $this->repository->save($review);

        $this->publisher->publish(...$review->pullDomainEvents());
    }
}
