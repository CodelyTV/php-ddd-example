<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\VideoHighlight\Application\Create;

use CodelyTv\Mooc\VideoHighlight\Domain\VideoHighlight;
use CodelyTv\Mooc\VideoHighlight\Domain\VideoHighlightId;
use CodelyTv\Mooc\VideoHighlight\Domain\VideoHighlightMessage;
use CodelyTv\Mooc\VideoHighlight\Domain\VideoHighlightRepository;
use CodelyTv\Shared\Domain\Bus\Event\DomainEventPublisher;
use CodelyTv\Shared\Domain\SecondsInterval;

final class VideoHighlightCreator
{
    private $repository;
    private $publisher;

    public function __construct(VideoHighlightRepository $repository, DomainEventPublisher $publisher)
    {
        $this->repository = $repository;
        $this->publisher  = $publisher;
    }

    public function create(VideoHighlightId $id, SecondsInterval $interval, VideoHighlightMessage $message)
    {
        $videoHighlight = VideoHighlight::create($id, $interval, $message);

        $this->repository->save($videoHighlight);

        $this->publisher->publish(...$videoHighlight->pullDomainEvents());
    }
}
