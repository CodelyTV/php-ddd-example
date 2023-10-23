<?php

declare(strict_types=1);

namespace CodelyTv\Mooc\Videos\Domain;

use CodelyTv\Mooc\Shared\Domain\Courses\CourseId;
use CodelyTv\Mooc\Shared\Domain\Videos\VideoUrl;
use CodelyTv\Shared\Domain\Aggregate\AggregateRoot;

final class Video extends AggregateRoot
{
	public function __construct(
		private readonly VideoId $id,
		private readonly VideoType $type,
		private VideoTitle $title,
		private readonly VideoUrl $url,
		private readonly CourseId $courseId
	) {}

	public static function create(
		VideoId $id,
		VideoType $type,
		VideoTitle $title,
		VideoUrl $url,
		CourseId $courseId
	): self {
		$video = new self($id, $type, $title, $url, $courseId);

		$video->record(
			new VideoCreatedDomainEvent($id->value(), $type->value, $title->value(), $url->value(), $courseId->value())
		);

		return $video;
	}

	public function updateTitle(VideoTitle $newTitle): void
	{
		$this->title = $newTitle;
	}

	public function id(): VideoId
	{
		return $this->id;
	}

	public function type(): VideoType
	{
		return $this->type;
	}

	public function title(): VideoTitle
	{
		return $this->title;
	}

	public function url(): VideoUrl
	{
		return $this->url;
	}

	public function courseId(): CourseId
	{
		return $this->courseId;
	}
}
