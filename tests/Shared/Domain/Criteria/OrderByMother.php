<?php

declare(strict_types=1);

namespace CodelyTv\Tests\Shared\Domain\Criteria;

use CodelyTv\Shared\Domain\Criteria\OrderBy;
use CodelyTv\Tests\Shared\Domain\WordMother;

final class OrderByMother
{
	public static function create(?string $fieldName = null): OrderBy
	{
		return new OrderBy($fieldName ?? WordMother::create());
	}
}
