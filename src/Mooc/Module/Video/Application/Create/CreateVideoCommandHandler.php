<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\Module\Video\Application\Create;

use CodelyTv\Mooc\Module\Video\Domain\VideoId;
use CodelyTv\Mooc\Module\Video\Domain\VideoTitle;
use CodelyTv\Mooc\Module\Video\Domain\VideoType;
use CodelyTv\Mooc\Module\Video\Domain\VideoUrl;
use CodelyTv\Shared\Domain\Bus\Command\CommandHandler;
use CodelyTv\Shared\Domain\CourseId;

final class CreateVideoCommandHandler implements CommandHandler
{
    private $creator;

    public function __construct(VideoCreator $creator)
    {
        $this->creator = $creator;
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
