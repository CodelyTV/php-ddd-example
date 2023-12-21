<?php

declare(strict_types=1);

namespace CodelyTv\Mooc\Videos\Domain;

use CodelyTv\Shared\Domain\DomainError;
use Override;

final class VideoNotFound extends DomainError
{
	public function __construct(private readonly VideoId $id)
	{
		parent::__construct();
	}

	#[Override]
	public function errorCode(): string
	{
		return 'video_not_found';
	}

	#[Override]
	protected function errorMessage(): string
	{
		return sprintf('The video <%s> has not been found', $this->id->value());
	}
}
