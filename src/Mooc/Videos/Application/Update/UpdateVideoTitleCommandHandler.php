<?php

namespace CodelyTv\Mooc\Videos\Application\Update;

use CodelyTv\Mooc\Videos\Domain\VideoId;
use CodelyTv\Mooc\Videos\Domain\VideoTitle;
use CodelyTv\Shared\Domain\Bus\Command\CommandHandler;

class UpdateVideoTitleCommandHandler implements CommandHandler
{

    private VideoTitleUpdater $titleUpdater;

    public function __construct(VideoTitleUpdater $titleUpdater)
    {
        $this->titleUpdater = $titleUpdater;
    }

    public function __invoke(UpdateVideoTitleCommand $command)
    {
        $id = new VideoId($command->id());
        $title = new VideoTitle($command->title());

        $this->titleUpdater->__invoke($id, $title);
    }
}
