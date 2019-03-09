<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\VideoHighlights\Application\Create;

use CodelyTv\Mooc\VideoHighlights\Domain\VideoHighlight;
use CodelyTv\Mooc\VideoHighlights\Domain\VideoHighlightId;
use CodelyTv\Mooc\VideoHighlights\Domain\VideoHighlightMessage;
use CodelyTv\Mooc\VideoHighlights\Domain\VideoHighlightRepository;
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

    public function create(VideoHighlightId $id, SecondsInterval $interval, VideoHighlightMessage $message): void
    {
        $videoHighlight = VideoHighlight::create($id, $interval, $message);

        $this->repository->save($videoHighlight);

        $this->publisher->publish(...$videoHighlight->pullDomainEvents());
    }
}
