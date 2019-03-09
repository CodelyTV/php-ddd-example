<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\VideoComments\Application\Publish;

use CodelyTv\Mooc\VideoComments\Domain\VideoComment;
use CodelyTv\Mooc\VideoComments\Domain\VideoCommentContent;
use CodelyTv\Mooc\VideoComments\Domain\VideoCommentId;
use CodelyTv\Mooc\VideoComments\Domain\VideoCommentRepository;
use CodelyTv\Mooc\Videos\Application\Find\FindVideoQuery;
use CodelyTv\Mooc\Videos\Domain\VideoId;
use CodelyTv\Shared\Domain\Bus\Event\DomainEventPublisher;
use CodelyTv\Shared\Domain\Bus\Query\QueryBus;

final class VideoCommentPublisher
{
    private $repository;
    private $bus;
    private $publisher;

    public function __construct(VideoCommentRepository $repository, QueryBus $bus, DomainEventPublisher $publisher)
    {
        $this->repository = $repository;
        $this->bus        = $bus;
        $this->publisher  = $publisher;
    }

    public function publish(VideoCommentId $id, VideoId $videoId, VideoCommentContent $content): void
    {
        $this->ensureVideoExist($videoId);

        $comment = VideoComment::publish($id, $videoId, $content);

        $this->repository->save($comment);

        $this->publisher->publish(...$comment->pullDomainEvents());
    }

    private function ensureVideoExist(VideoId $id): void
    {
        $this->bus->ask(new FindVideoQuery($id->value()));
    }
}
