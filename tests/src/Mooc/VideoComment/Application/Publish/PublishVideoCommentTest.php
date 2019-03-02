<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Mooc\VideoComment\Application\Publish;

use CodelyTv\Mooc\VideoComment\Application\Publish\PublishVideoCommentCommandHandler;
use CodelyTv\Mooc\VideoComment\Application\Publish\VideoCommentPublisher;
use CodelyTv\Mooc\VideoComment\Domain\VideoComment;
use CodelyTv\Mooc\VideoComment\Domain\VideoCommentRepository;
use CodelyTv\Test\Mooc\Shared\Infrastructure\MoocContextUnitTestCase;
use CodelyTv\Test\Mooc\Video\Domain\VideoIdMother;
use CodelyTv\Test\Mooc\VideoComment\Domain\VideoCommentContentMother;
use CodelyTv\Test\Mooc\VideoComment\Domain\VideoCommentIdMother;
use CodelyTv\Test\Mooc\VideoComment\Domain\VideoCommentMother;
use CodelyTv\Test\Mooc\VideoComment\Domain\VideoCommentPublishedDomainEventMother;
use Mockery\MockInterface;
use function CodelyTv\Test\similarTo;

final class PublishVideoCommentTest extends MoocContextUnitTestCase
{
    private $handler;
    private $repository;

    protected function setUp()
    {
        parent::setUp();

        $publisher = new VideoCommentPublisher($this->repository(), $this->domainEventPublisher());

        $this->handler = new PublishVideoCommentCommandHandler($publisher);
    }

    /** @test */
    public function it_should_publish_a_video(): void
    {
        $command = PublishVideoCommentCommandMother::random();

        $id      = VideoCommentIdMother::create($command->id());
        $videoId = VideoIdMother::create($command->videoId());
        $content = VideoCommentContentMother::create($command->content());

        $comment = VideoCommentMother::create($id, $videoId, $content);

        $domainEvent = VideoCommentPublishedDomainEventMother::create($id, $videoId, $content);

        $this->shouldSaveVideoComment($comment);
        $this->shouldPublishDomainEvents($domainEvent);

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
