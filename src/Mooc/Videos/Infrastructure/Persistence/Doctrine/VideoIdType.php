<?php

declare(strict_types=1);

namespace CodelyTv\Mooc\Videos\Infrastructure\Persistence\Doctrine;

use CodelyTv\Mooc\Videos\Domain\VideoId;
use CodelyTv\Shared\Infrastructure\Persistence\Doctrine\UuidType;
use Override;

final class VideoIdType extends UuidType
{
	#[Override]
	protected function typeClassName(): string
	{
		return VideoId::class;
	}
}
