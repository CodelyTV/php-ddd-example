<?php

declare(strict_types=1);

namespace CodelyTv\Mooc\Videos\Application\Create;

use CodelyTv\Mooc\Shared\Domain\Courses\CourseId;
use CodelyTv\Mooc\Shared\Domain\Videos\VideoUrl;
use CodelyTv\Mooc\Videos\Domain\VideoId;
use CodelyTv\Mooc\Videos\Domain\VideoTitle;
use CodelyTv\Mooc\Videos\Domain\VideoType;
use CodelyTv\Shared\Domain\Bus\Command\CommandHandler;

final readonly class CreateVideoCommandHandler implements CommandHandler
{
	public function __construct(private VideoCreator $creator) {}

	public function __invoke(CreateVideoCommand $command): void
	{
		$id = new VideoId($command->id());
		$type = VideoType::from($command->type());
		$title = new VideoTitle($command->title());
		$url = new VideoUrl($command->url());
		$courseId = new CourseId($command->courseId());

		$this->creator->create($id, $type, $title, $url, $courseId);
	}
}
