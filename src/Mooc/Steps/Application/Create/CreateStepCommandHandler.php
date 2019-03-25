<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\Steps\Application\Create;

use CodelyTv\Mooc\Videos\Application\Create\CreateVideoCommand;
use CodelyTv\Mooc\Videos\Domain\VideoId;
use CodelyTv\Shared\Domain\Bus\Command\CommandHandler;

final class CreateStepCommandHandler implements CommandHandler
{
    private $creator;

    public function __construct(StepCreator $creator)
    {
        $this->creator = $creator;
    }

    public function __invoke(CreateVideoCommand $command)
    {
        $id = new VideoId($command->id());

        $this->creator->__invoke($id);
    }
}
