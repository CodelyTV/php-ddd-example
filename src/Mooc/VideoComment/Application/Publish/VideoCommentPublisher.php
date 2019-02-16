<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\VideoComment\Application\Publish;

use CodelyTv\Mooc\Video\Domain\VideoId;
use CodelyTv\Mooc\VideoComment\Domain\VideoComment;
use CodelyTv\Mooc\VideoComment\Domain\VideoCommentContent;
use CodelyTv\Mooc\VideoComment\Domain\VideoCommentId;
use CodelyTv\Mooc\VideoComment\Domain\VideoCommentRepository;
use CodelyTv\Shared\Domain\Bus\Event\DomainEventPublisher;

final class VideoCommentPublisher
{
    private $repository;
    private $publisher;

    public function __construct(VideoCommentRepository $repository, DomainEventPublisher $publisher)
    {
        $this->repository = $repository;
        $this->publisher  = $publisher;
    }

    public function publish(VideoCommentId $id, VideoId $videoId, VideoCommentContent $content)
    {
        $comment = VideoComment::publish($id, $videoId, $content);

        $this->repository->save($comment);

        $this->publisher->publish(...$comment->pullDomainEvents());
    }
}
