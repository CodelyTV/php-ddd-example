<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Context\Video\Module\VideoComment\Application\Publish;

use CodelyTv\Context\Video\Module\VideoComment\Application\Publish\PublishVideoCommentCommandHandler;
use CodelyTv\Context\Video\Module\VideoComment\Application\Publish\VideoCommentPublisher;
use CodelyTv\Context\Video\Module\VideoComment\Domain\VideoComment;
use CodelyTv\Context\Video\Module\VideoComment\Domain\VideoCommentRepository;
use CodelyTv\Test\Context\Video\Module\Video\Domain\VideoIdStub;
use CodelyTv\Test\Context\Video\Module\VideoComment\Domain\VideoCommentContentStub;
use CodelyTv\Test\Context\Video\Module\VideoComment\Domain\VideoCommentIdStub;
use CodelyTv\Test\Context\Video\Module\VideoComment\Domain\VideoCommentPublishedDomainEventStub;
use CodelyTv\Test\Context\Video\Module\VideoComment\Domain\VideoCommentStub;
use CodelyTv\Test\Context\Video\VideoContextUnitTestCase;
use Mockery\MockInterface;
use function CodelyTv\Test\similarTo;

final class PublishVideoCommentTest extends VideoContextUnitTestCase
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
    public function it_should_publish_a_video()
    {
        $command = PublishVideoCommentCommandStub::random();

        $id      = VideoCommentIdStub::create($command->id());
        $videoId = VideoIdStub::create($command->videoId());
        $content = VideoCommentContentStub::create($command->content());

        $comment = VideoCommentStub::create($id, $videoId, $content);

        $domainEvent = VideoCommentPublishedDomainEventStub::create($id, $videoId, $content);

        $this->shouldSaveVideoComment($comment);
        $this->shouldPublishDomainEvents($domainEvent);

        $this->dispatch($command, $this->handler);
    }

    /** @return VideoCommentRepository|MockInterface */
    private function repository()
    {
        return $this->repository = $this->repository ?: $this->mock(VideoCommentRepository::class);
    }

    private function shouldSaveVideoComment(VideoComment $comment)
    {
        $this->repository()
            ->shouldReceive('save')
            ->once()
            ->with(similarTo($comment))
            ->andReturnNull();
    }
}
