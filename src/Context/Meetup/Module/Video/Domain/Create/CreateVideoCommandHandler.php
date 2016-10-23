<?php

namespace CodelyTv\Context\Meetup\Module\Video\Domain\Create;

use CodelyTv\Context\Meetup\Module\Video\Domain\VideoId;
use CodelyTv\Context\Meetup\Module\Video\Domain\VideoTitle;
use CodelyTv\Context\Meetup\Module\Video\Domain\VideoUrl;
use CodelyTv\Infrastructure\Bus\Command\Command;
use CodelyTv\Shared\Domain\CourseId;

final class CreateVideoCommandHandler implements Command
{
    private $creator;

    public function __construct(VideoCreator $creator)
    {
        $this->creator = $creator;
    }

    public function __invoke(CreateVideoCommand $command)
    {
        $id       = new VideoId($command->id());
        $title    = new VideoTitle($command->title());
        $url      = new VideoUrl($command->url());
        $courseId = new CourseId($command->courseId());

        $this->creator->create($id, $title, $url, $courseId);
    }
}
