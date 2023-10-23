<?php

declare(strict_types=1);

namespace CodelyTv\Backoffice\Auth\Domain;

use RuntimeException;

final class InvalidAuthUsername extends RuntimeException
{
	public function __construct(AuthUsername $username)
	{
		parent::__construct(sprintf('The user <%s> does not exists', $username->value()));
	}
}
