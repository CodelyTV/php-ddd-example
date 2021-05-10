<?php

declare(strict_types=1);

namespace CodelyTv\Mooc\Videos\Application\Update;


use CodelyTv\Mooc\Videos\Domain\VideoId;
use CodelyTv\Mooc\Videos\Domain\VideoTitle;

final class UpdateVideoTitleCommandHandler
{

    public function __construct(private VideoTitleUpdater $titleUpdater)
    {
    }

    public function __invoke(UpdateVideoTitleCommand $command)
    {
        $id    = new VideoId($command->getId());
        $title = new VideoTitle($command->getTitle());

        $this->titleUpdater->__invoke($id, $title);
    }
}
