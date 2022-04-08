<?php

declare(strict_types=1);

namespace CodelyTv\Mooc\Videos\Application\Create;

use CodelyTv\Mooc\Videos\Application\Update\VideoDescriptionUpdater;
use CodelyTv\Mooc\Videos\Domain\VideoDescription;
use CodelyTv\Mooc\Videos\Domain\VideoId;
use CodelyTv\Shared\Domain\Bus\Command\CommandHandler;

final class UpdateVideoDescriptionCommandHandler implements CommandHandler
{
    public function __construct(private VideoDescriptionUpdater $update)
    {
    }

    public function __invoke(CreateVideoCommand $command)
    {
        $id = new VideoId($command->id());
        $description = new VideoDescription($command->description());

        $this->update->__invoke($id, $description);
    }
}