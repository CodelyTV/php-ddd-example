<?php

namespace CodelyTv\Tests\Shared;

use ArrayIterator;
use BackedEnum;
use CodelyTv\Backoffice\Auth\Application\Authenticate\AuthenticateUserCommand;
use Countable;
use DateTimeImmutable;
use DateTimeInterface;
use DomainException;
use InvalidArgumentException;
use IteratorAggregate;
use PHPat\Selector\Selector;
use PHPat\Test\Builder\Rule;
use PHPat\Test\PHPat;
use Ramsey\Uuid\Uuid;
use ReflectionClass;
use RuntimeException;
use Stringable;
use Throwable;
use Traversable;

final class ArchitectureTest
{
    public function test_shared_domain_should_not_import_from_outside(): Rule
    {
        return PHPat::rule()
            ->classes(Selector::inNamespace('CodelyTv\Shared\Domain'))
            ->canOnlyDependOn()
            ->classes(
                Selector::inNamespace('CodelyTv\Shared'),
                // Dependencies
                Selector::classname(Uuid::class),
                // Language classes
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
                Selector::classname(ReflectionClass::class),
            )
            ->because('shared domain cannot import from outside');
    }
}
