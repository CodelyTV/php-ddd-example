<?php

declare(strict_types=1);

namespace CodelyTv\Mooc\Videos\Domain;

use CodelyTv\Shared\Domain\Bus\Event\DomainEvent;
use Override;

final class VideoCreatedDomainEvent extends DomainEvent
{
	public function __construct(
		string $id,
		private readonly string $type,
		private readonly string $title,
		private readonly string $url,
		private readonly string $courseId,
		string $eventId = null,
		string $occurredOn = null
	) {
		parent::__construct($id, $eventId, $occurredOn);
	}

	#[Override]
	public static function eventName(): string
	{
		return 'video.created';
	}

	#[Override]
	public static function fromPrimitives(
		string $aggregateId,
		array $body,
		string $eventId,
		string $occurredOn
	): self {
		return new self(
			$aggregateId,
			$body['type'],
			$body['title'],
			$body['url'],
			$body['course_id'],
			$eventId,
			$occurredOn
		);
	}

	#[Override]
	public function toPrimitives(): array
	{
		return [
			'type' => $this->type,
			'title' => $this->title,
			'url' => $this->url,
			'course_id' => $this->courseId,
		];
	}
}
