<?php

declare(strict_types=1);

namespace CodelyTv\Test\Context\Video\Module\Video\Application\Create;

use CodelyTv\Context\Video\Module\Review\Application\Create\CreateVideoReviewCommandHandler;
use CodelyTv\Context\Video\Module\Review\Application\Create\ReviewCreator;
use CodelyTv\Test\Context\Video\Module\Review\Application\Create\CreateVideoReviewCommandStub;
use CodelyTv\Test\Context\Video\Module\Review\Domain\ReviewCreatedDomainEventStub;
use CodelyTv\Test\Context\Video\Module\Review\Domain\ReviewIdStub;
use CodelyTv\Test\Context\Video\Module\Review\Domain\ReviewRatingStub;
use CodelyTv\Test\Context\Video\Module\Review\Domain\ReviewStub;
use CodelyTv\Test\Context\Video\Module\Review\Domain\ReviewTextStub;
use CodelyTv\Test\Context\Video\Module\Review\ReviewModuleUnitTestCase;
use CodelyTv\Test\Context\Video\Module\Video\Domain\VideoIdStub;

final class CreateVideoReviewTest extends ReviewModuleUnitTestCase
{
    /** @var CreateVideoReviewCommandHandler */
    private $handler;

    protected function setUp()
    {
        parent::setUp();

        $creator = new ReviewCreator($this->repository(), $this->domainEventPublisher());

        $this->handler = new CreateVideoReviewCommandHandler($creator);
    }

    /** @test */
    public function it_should_create_a_review()
    {
        $command = CreateVideoReviewCommandStub::random();

        $id = ReviewIdStub::create($command->id());
        $videoId = VideoIdStub::create($command->videoId());
        $rating = ReviewRatingStub::create($command->rating());
        $text = ReviewTextStub::create($command->text());

        $review = ReviewStub::create($id, $videoId, $rating, $text);

        $domainEvent = ReviewCreatedDomainEventStub::create($id, $videoId, $rating, $text);

        $this->shouldSaveReview($review);
        $this->shouldPublishDomainEvents($domainEvent);

        $this->dispatch($command, $this->handler);
    }
}
