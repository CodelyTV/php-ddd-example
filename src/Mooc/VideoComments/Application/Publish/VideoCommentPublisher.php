<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\VideoComments\Application\Publish;

use CodelyTv\Mooc\VideoComments\Domain\VideoComment;
use CodelyTv\Mooc\VideoComments\Domain\VideoCommentContent;
use CodelyTv\Mooc\VideoComments\Domain\VideoCommentId;
use CodelyTv\Mooc\VideoComments\Domain\VideoCommentRepository;
use CodelyTv\Mooc\Videos\Domain\VideoId;
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

    public function publish(VideoCommentId $id, VideoId $videoId, VideoCommentContent $content): void
    {
        $comment = VideoComment::publish($id, $videoId, $content);

        $this->repository->save($comment);

        $this->publisher->publish(...$comment->pullDomainEvents());
    }
}
