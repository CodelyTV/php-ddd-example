<?php

declare(strict_types=1);

namespace CodelyTv\Mooc\Videos\Application\Update;

use CodelyTv\Mooc\Videos\Domain\VideoId;
use CodelyTv\Mooc\Videos\Domain\VideoTitle;
use CodelyTv\Shared\Domain\Bus\Command\CommandHandler;

final class UpdateVideoTitleCommandHandler implements CommandHandler
{
    public function __construct(private VideoTitleUpdater $updater) { }

    public function __invoke(UpdateVideoTitleCommand $command) {
        $id       = new VideoId($command->id());
        $title    = new VideoTitle($command->title());

        $this->updater->__invoke($id, $title);
    }
}
