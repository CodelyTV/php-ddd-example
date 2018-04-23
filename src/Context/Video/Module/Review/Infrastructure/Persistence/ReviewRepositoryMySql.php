<?php

declare(strict_types=1);

namespace CodelyTv\Context\Video\Module\Review\Infrastructure\Persistence;

use CodelyTv\Context\Video\Module\Review\Domain\Review;
use CodelyTv\Context\Video\Module\Review\Domain\ReviewId;
use CodelyTv\Context\Video\Module\Review\Domain\ReviewRepository;
use CodelyTv\Infrastructure\Doctrine\Repository;

final class ReviewRepositoryMySql extends Repository implements ReviewRepository
{
    public function save(Review $review): void
    {
        $this->persist($review);
    }

    public function search(ReviewId $id): ?Review
    {
        return $this->repository(Review::class)->find($id);
    }
}
