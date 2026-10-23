<?php

declare(strict_types=1);

namespace CodelyTv\Mooc\Videos\Domain;

use CodelyTv\Mooc\Shared\Domain\Videos\VideoUrl;

interface VideoPublishedNotifier
{
	public function notify(VideoTitle $title, VideoUrl $url): void;
}
