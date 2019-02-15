<?php

declare(strict_types = 1);

namespace CodelyTv\Context\Mooc\Module\VideoComment\Application\Publish;

use CodelyTv\Context\Mooc\Module\Video\Domain\VideoId;
use CodelyTv\Context\Mooc\Module\VideoComment\Domain\VideoComment;
use CodelyTv\Context\Mooc\Module\VideoComment\Domain\VideoCommentContent;
use CodelyTv\Context\Mooc\Module\VideoComment\Domain\VideoCommentId;
use CodelyTv\Context\Mooc\Module\VideoComment\Domain\VideoCommentRepository;
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
