<?php

declare(strict_types=1);

namespace CodelyTv\Tests\Shared;

use ArrayIterator;
use BackedEnum;
use CodelyTv\Backoffice\Auth\Application\Authenticate\AuthenticateUserCommand;
use CodelyTv\Tests\Shared\Infrastructure\Doctrine\MySqlDatabaseCleaner;
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

final class SharedArchitectureTest
{
    public function test_shared_domain_should_not_import_from_outside(): Rule
    {
        return PHPat::rule()
            ->classes(Selector::inNamespace('CodelyTv\Shared\Domain'))
            ->canOnlyDependOn()
            ->classes(...array_merge($this->languageClasses(), [
                // Itself
                Selector::inNamespace('CodelyTv\Shared\Domain'),
                // Dependencies treated as domain
                Selector::classname(Uuid::class),
            ]))
            ->because('shared domain cannot import from outside');
    }

    public function test_shared_infrastructure_should_not_import_from_other_contexts(): Rule
    {
        return PHPat::rule()
            ->classes(Selector::inNamespace('CodelyTv\Shared\Infrastructure'))
            ->shouldNotDependOn()
            ->classes(Selector::inNamespace('CodelyTv'))
            ->excluding(
                // Itself
                Selector::inNamespace('CodelyTv\Shared'),
                // This need to be refactored
                Selector::classname(MySqlDatabaseCleaner::class),
                Selector::classname(AuthenticateUserCommand::class),
            );
    }

    private function languageClasses(): array
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
            Selector::classname(ReflectionClass::class),
        ];
    }
}
