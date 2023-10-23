<?php

declare(strict_types=1);

namespace CodelyTv\Tests\Shared;

use CodelyTv\Backoffice\Auth\Application\Authenticate\AuthenticateUserCommand;
use CodelyTv\Shared\Domain\Bus\Event\DomainEventSubscriber;
use CodelyTv\Shared\Domain\Bus\Query\Response;
use CodelyTv\Tests\Shared\Infrastructure\ArchitectureTest;
use CodelyTv\Tests\Shared\Infrastructure\Doctrine\MySqlDatabaseCleaner;
use PHPat\Selector\Selector;
use PHPat\Test\Builder\Rule;
use PHPat\Test\PHPat;
use Ramsey\Uuid\Uuid;

final class SharedArchitectureTest
{
	public function test_shared_domain_should_not_import_from_outside(): Rule
	{
		return PHPat::rule()
			->classes(Selector::inNamespace('CodelyTv\Shared\Domain'))
			->canOnlyDependOn()
			->classes(...array_merge(ArchitectureTest::languageClasses(), [
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

	public function test_all_use_cases_can_only_have_one_public_method(): Rule
	{
		return PHPat::rule()
			->classes(
				Selector::classname('/^CodelyTv\\\\.+\\\\.+\\\\Application\\\\.+\\\\(?!.*(?:Command|Query)$).*$/', true)
			)
			->excluding(
				Selector::implements(Response::class),
				Selector::implements(DomainEventSubscriber::class),
				Selector::inNamespace('/.*\\\\Tests\\\\.*/', true)
			)
			->shouldHaveOnlyOnePublicMethod();
	}
}
