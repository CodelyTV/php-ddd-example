<?php

declare(strict_types=1);

namespace CodelyTv\Context\Video\Module\Review\Domain;

interface ReviewRepository
{
    public function save(Review $review): void;

    public function search(ReviewId $id): ?Review;
}
