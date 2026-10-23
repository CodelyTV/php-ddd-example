<?php

declare(strict_types=1);

namespace CodelyTv\Mooc\Videos\Application\Notify;

use CodelyTv\Mooc\Shared\Domain\Videos\VideoUrl;
use CodelyTv\Mooc\Videos\Domain\VideoPublishedNotifier;
use CodelyTv\Mooc\Videos\Domain\VideoTitle;

final readonly class VideoPublishedNotificator
{
	public function __construct(private VideoPublishedNotifier $notifier) {}

	public function __invoke(VideoTitle $title, VideoUrl $url): void
	{
		$this->notifier->notify($title, $url);
	}
}
