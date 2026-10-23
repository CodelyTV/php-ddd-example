<?php

declare(strict_types=1);

namespace CodelyTv\Tests\Mooc\Videos\Domain;

use CodelyTv\Mooc\Videos\Domain\VideoCreatedDomainEvent;
use CodelyTv\Mooc\Videos\Domain\VideoType;
use CodelyTv\Tests\Shared\Domain\MotherCreator;
use CodelyTv\Tests\Shared\Domain\UuidMother;

final class VideoCreatedDomainEventMother
{
	public static function create(?string $title = null, ?string $url = null): VideoCreatedDomainEvent
	{
		return new VideoCreatedDomainEvent(
			UuidMother::create(),
			VideoType::SCREENCAST->value,
			$title ?? MotherCreator::random()->sentence(3),
			$url ?? MotherCreator::random()->url,
			UuidMother::create()
		);
	}
}
