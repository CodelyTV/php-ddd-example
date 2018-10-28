<?php

declare(strict_types = 1);

namespace CodelyTv\Context\Video\Module\Video\Application\Update;

use CodelyTv\Context\Video\Module\Video\Domain\VideoId;
use CodelyTv\Context\Video\Module\Video\Domain\VideoTitle;
use CodelyTv\Shared\Domain\Bus\Command\CommandHandler;

final class UpdateVideoTitleCommandHandler implements CommandHandler
{
    private $updater;

    public function __construct(VideoTitleUpdater $updater)
    {
        $this->updater = $updater;
    }

    public function __invoke(UpdateVideoTitleCommand $command)
    {
        $id       = new VideoId($command->id());
        $title    = new VideoTitle($command->title());

        $this->updater->__invoke($id, $title);
    }
}
