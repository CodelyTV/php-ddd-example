<?php

declare(strict_types = 1);

namespace CodelyTv\Context\Video\Module\VideoHighlight\Application\Create;

use CodelyTv\Context\Video\Module\VideoHighlight\Domain\VideoHighlightId;
use CodelyTv\Context\Video\Module\VideoHighlight\Domain\VideoHighlightMessage;
use CodelyTv\Shared\Domain\Bus\Command\CommandHandler;
use CodelyTv\Shared\Domain\SecondsInterval;

final class CreateVideoHighlightCommandHandler implements CommandHandler
{
    private $creator;

    public function __construct(VideoHighlightCreator $creator)
    {
        $this->creator = $creator;
    }

    public function __invoke(CreateVideoHighlightCommand $command)
    {
        $id       = new VideoHighlightId($command->id());
        $interval = SecondsInterval::fromValues($command->from(), $command->to());
        $message  = new VideoHighlightMessage($command->message());

        $this->creator->create($id, $interval, $message);
    }
}
