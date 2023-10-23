<?php

declare(strict_types=1);

namespace CodelyTv\Tests\Mooc\CoursesCounter\Domain;

use CodelyTv\Mooc\CoursesCounter\Domain\CoursesCounterTotal;
use CodelyTv\Tests\Shared\Domain\IntegerMother;

final class CoursesCounterTotalMother
{
	public static function create(?int $value = null): CoursesCounterTotal
	{
		return new CoursesCounterTotal($value ?? IntegerMother::create());
	}

	public static function one(): CoursesCounterTotal
	{
		return self::create(1);
	}

	public static function random(): CoursesCounterTotal
	{
		return self::create(IntegerMother::create());
	}
}
