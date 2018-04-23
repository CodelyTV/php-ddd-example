<?php

declare(strict_types=1);

namespace CodelyTv\Test\Context\Video\Module\Review;

use CodelyTv\Context\Video\Module\Review\Domain\Review;
use CodelyTv\Context\Video\Module\Review\Domain\ReviewRepository;
use CodelyTv\Test\Context\Video\VideoContextUnitTestCase;
use Mockery\MockInterface;
use function CodelyTv\Test\similarTo;

abstract class ReviewModuleUnitTestCase extends VideoContextUnitTestCase
{
    private $repository;

    /** @return ReviewRepository|MockInterface */
    protected function repository()
    {
        return $this->repository = $this->repository ?: $this->mock(ReviewRepository::class);
    }

    protected function shouldSaveReview(Review $review)
    {
        $this->repository()
            ->shouldReceive('save')
            ->with(similarTo($review))
            ->once()
            ->andReturnNull();
    }
}
