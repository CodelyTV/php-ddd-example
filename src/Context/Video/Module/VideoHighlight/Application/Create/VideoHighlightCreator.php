<?php

namespace CodelyTv\Context\Video\Module\VideoHighlight\Application\Create;

use CodelyTv\Context\Video\Module\VideoHighlight\Domain\VideoHighlight;
use CodelyTv\Context\Video\Module\VideoHighlight\Domain\VideoHighlightId;
use CodelyTv\Context\Video\Module\VideoHighlight\Domain\VideoHighlightMessage;
use CodelyTv\Context\Video\Module\VideoHighlight\Domain\VideoHighlightRepository;
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
