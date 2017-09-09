<?php

declare(strict_types=1);

namespace CodelyTv\Context\Video\Module\VideoComment\Tests\Behaviour;

use CodelyTv\Context\Video\Module\Video\Test\Stub\PublishVideoCommentCommandStub;
use CodelyTv\Context\Video\Module\Video\Test\Stub\VideoCommentContentStub;
use CodelyTv\Context\Video\Module\Video\Test\Stub\VideoCommentIdStub;
use CodelyTv\Context\Video\Module\Video\Test\Stub\VideoCommentPublishedDomainEventStub;
use CodelyTv\Context\Video\Module\Video\Test\Stub\VideoCommentStub;
use CodelyTv\Context\Video\Module\Video\Test\Stub\VideoIdStub;
use CodelyTv\Context\Video\Module\VideoComment\Application\Publish\PublishVideoCommentCommandHandler;
use CodelyTv\Context\Video\Module\VideoComment\Application\Publish\VideoCommentPublisher;
use CodelyTv\Context\Video\Module\VideoComment\Domain\VideoComment;
use CodelyTv\Context\Video\Module\VideoComment\Domain\VideoCommentRepository;
use CodelyTv\Context\Video\Test\PhpUnit\VideoContextUnitTestCase;
use function CodelyTv\Test\similarTo;
use Mockery\MockInterface;

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
        $this->shouldPublishDomainEvents([$domainEvent]);

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
