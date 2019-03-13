<?php

declare(strict_types=1);

namespace CodelyTv\Mooc\Videos\Application\Update;

use CodelyTv\Mooc\Videos\Application\Find\VideoFinder;
use CodelyTv\Mooc\Videos\Domain\VideoId;
use CodelyTv\Mooc\Videos\Domain\VideoTitle;

final class UpdateVideoCommandHandler
{
    private $videoTitleUpdater;

    private $videoFinder;

    public function __construct(VideoTitleUpdater $videoTitleUpdater, VideoFinder $videoFinder)
    {
        $this->videoTitleUpdater = $videoTitleUpdater;
        $this->videoFinder = $videoFinder;
    }

    public function __invoke(UpdateVideoTitleCommand $command)
    {
        $video = $this->videoFinder->__invoke(new VideoId($command->id()->value()));

        $this->videoTitleUpdater->__invoke($video->id(), new VideoTitle($command->title()));
    }
}