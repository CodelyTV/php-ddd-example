<?php

declare(strict_types=1);

namespace CodelyTv\Mooc\Videos\Application\Update;

use CodelyTv\Mooc\Videos\Domain\VideoId;
use CodelyTv\Mooc\Videos\Domain\VideoTitle;

final class UpdateVideoCommandHandler
{
    private $videoTitleUpdater;

    public function __construct(VideoTitleUpdater $videoTitleUpdater)
    {
        $this->videoTitleUpdater = $videoTitleUpdater;
    }

    public function __invoke(UpdateVideoTitleCommand $command)
    {
        $this->videoTitleUpdater->__invoke(
            new VideoId($command->id()),
            new VideoTitle($command->title())
        );
    }
}