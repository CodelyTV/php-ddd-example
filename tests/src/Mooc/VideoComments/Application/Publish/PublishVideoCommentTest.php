<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Mooc\VideoComments\Application\Publish;

use CodelyTv\Mooc\VideoComments\Application\Publish\PublishVideoCommentCommandHandler;
use CodelyTv\Mooc\VideoComments\Application\Publish\VideoCommentPublisher;
use CodelyTv\Mooc\VideoComments\Domain\VideoComment;
use CodelyTv\Mooc\VideoComments\Domain\VideoCommentRepository;
use CodelyTv\Mooc\Videos\Domain\VideoNotFound;
use CodelyTv\Test\Mooc\Shared\Infrastructure\MoocContextUnitTestCase;
use CodelyTv\Test\Mooc\VideoComments\Domain\VideoCommentContentMother;
use CodelyTv\Test\Mooc\VideoComments\Domain\VideoCommentIdMother;
use CodelyTv\Test\Mooc\VideoComments\Domain\VideoCommentMother;
use CodelyTv\Test\Mooc\VideoComments\Domain\VideoCommentPublishedDomainEventMother;
use CodelyTv\Test\Mooc\Videos\Application\Find\FindVideoQueryMother;
use CodelyTv\Test\Mooc\Videos\Application\Find\VideoResponseMother;
use CodelyTv\Test\Mooc\Videos\Domain\VideoIdMother;
use Mockery\MockInterface;
use function CodelyTv\Test\Shared\similarTo;

final class PublishVideoCommentTest extends MoocContextUnitTestCase
{
    private $handler;
    private $repository;

    protected function setUp(): void
    {
        parent::setUp();

        $publisher = new VideoCommentPublisher($this->repository(), $this->queryBus(), $this->domainEventPublisher());

        $this->handler = new PublishVideoCommentCommandHandler($publisher);
    }

    /** @test */
    public function it_should_publish_a_video_comment(): void
    {
        $command = PublishVideoCommentCommandMother::random();

        $id      = VideoCommentIdMother::create($command->id());
        $videoId = VideoIdMother::create($command->videoId());
        $content = VideoCommentContentMother::create($command->content());

        $comment = VideoCommentMother::create($id, $videoId, $content);

        $domainEvent = VideoCommentPublishedDomainEventMother::create($id, $videoId, $content);

        $this->shouldAsk(FindVideoQueryMother::create($videoId), VideoResponseMother::withId($videoId));
        $this->shouldSaveVideoComment($comment);
        $this->shouldPublishDomainEvents($domainEvent);

        $this->dispatch($command, $this->handler);
    }

    /** @test */
    public function it_should_not_publish_a_video_comment_when_the_video_not_exist(): void
    {
        $this->expectException(VideoNotFound::class);

        $command = PublishVideoCommentCommandMother::random();

        $videoId = VideoIdMother::create($command->videoId());

        $this->shouldAskThrowingException(FindVideoQueryMother::create($videoId), new VideoNotFound($videoId));

        $this->dispatch($command, $this->handler);
    }

    /** @return VideoCommentRepository|MockInterface */
    private function repository()
    {
        return $this->repository = $this->repository ?: $this->mock(VideoCommentRepository::class);
    }

    private function shouldSaveVideoComment(VideoComment $comment): void
    {
        $this->repository()
            ->shouldReceive('save')
            ->once()
            ->with(similarTo($comment))
            ->andReturnNull();
    }
}
