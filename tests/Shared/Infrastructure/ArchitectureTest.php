<?php

declare(strict_types=1);

namespace CodelyTv\Tests\Shared\Infrastructure;

use ArrayIterator;
use BackedEnum;
use Countable;
use DateTimeImmutable;
use DateTimeInterface;
use DomainException;
use InvalidArgumentException;
use IteratorAggregate;
use PHPat\Selector\Selector;
use RuntimeException;
use Stringable;
use Throwable;
use Traversable;

final class ArchitectureTest
{
	public static function languageClasses(): array
	{
		return [
			Selector::classname(Throwable::class),
			Selector::classname(InvalidArgumentException::class),
			Selector::classname(RuntimeException::class),
			Selector::classname(DateTimeImmutable::class),
			Selector::classname(DateTimeInterface::class),
			Selector::classname(DomainException::class),
			Selector::classname(Stringable::class),
			Selector::classname(BackedEnum::class),
			Selector::classname(Countable::class),
			Selector::classname(IteratorAggregate::class),
			Selector::classname(Traversable::class),
			Selector::classname(ArrayIterator::class),
		];
	}
}
