<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\Videos\Application\Modify\Description;

use CodelyTv\Mooc\Shared\Domain\Courses\CourseId;
use CodelyTv\Mooc\Videos\Domain\VideoId;
use CodelyTv\Mooc\Videos\Domain\VideoDescription;
use CodelyTv\Shared\Domain\Bus\Command\CommandHandler;

final class ModifyDescriptionVideoCommandHandler implements CommandHandler
{
    private $modifier;

    public function __construct(VideoDescriptionModifier $modifier)
    {
        $this->modifier = $modifier;
    }

    public function __invoke(ModifyDescriptionVideoCommand $command)
    {
        $videoId       = new VideoId($command->videoId());
        $newDescrition = new VideoDescription($command->newDescription());

        $this->modifier->modify($videoId, $newDescrition);
    }
}