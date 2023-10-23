<?php

declare(strict_types=1);

namespace CodelyTv\Mooc\Videos\Application\Find;

use CodelyTv\Shared\Domain\Bus\Query\Response;

final readonly class VideoResponse implements Response
{
	public function __construct(
		private string $id,
		private string $type,
		private string $title,
		private string $url,
		private string $courseId
	) {}
}
