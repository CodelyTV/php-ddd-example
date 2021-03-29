<?php

declare(strict_types=1);

namespace CodelyTv\OpenFlight\Videos\Application\Create;

use CodelyTv\OpenFlight\Shared\Domain\Courses\CourseId;
use CodelyTv\OpenFlight\Shared\Domain\Videos\VideoUrl;
use CodelyTv\OpenFlight\Videos\Domain\VideoId;
use CodelyTv\OpenFlight\Videos\Domain\VideoTitle;
use CodelyTv\OpenFlight\Videos\Domain\VideoType;
use CodelyTv\Shared\Domain\Bus\Command\CommandHandler;

final class CreateVideoCommandHandler implements CommandHandler
{
    public function __construct(private VideoCreator $creator)
    {
    }

    public function __invoke(CreateVideoCommand $command)
    {
        $id       = new VideoId($command->id());
        $type     = new VideoType($command->type());
        $title    = new VideoTitle($command->title());
        $url      = new VideoUrl($command->url());
        $courseId = new CourseId($command->courseId());

        $this->creator->create($id, $type, $title, $url, $courseId);
    }
}
