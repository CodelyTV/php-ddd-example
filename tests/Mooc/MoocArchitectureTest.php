<?php

declare(strict_types=1);

namespace CodelyTv\Tests\Mooc;

use CodelyTv\Tests\Shared\Infrastructure\ArchitectureTest;
use PHPat\Selector\Selector;
use PHPat\Test\Builder\Rule;
use PHPat\Test\PHPat;

final class MoocArchitectureTest
{
	public function test_mooc_domain_should_only_import_itself_and_shared(): Rule
	{
		return PHPat::rule()
			->classes(Selector::inNamespace('/^CodelyTv\\\\Mooc\\\\.+\\\\Domain/', true))
			->canOnlyDependOn()
			->classes(...array_merge(ArchitectureTest::languageClasses(), [
				// Itself
				Selector::inNamespace('/^CodelyTv\\\\Mooc\\\\.+\\\\Domain/', true),
				// Shared
				Selector::inNamespace('CodelyTv\Shared\Domain'),
			]))
			->because('mooc domain can only import itself and shared domain');
	}

	public function test_mooc_application_should_only_import_itself_and_domain(): Rule
	{
		return PHPat::rule()
			->classes(Selector::inNamespace('/^CodelyTv\\\\Mooc\\\\.+\\\\Application/', true))
			->canOnlyDependOn()
			->classes(...array_merge(ArchitectureTest::languageClasses(), [
				// Itself
				Selector::inNamespace('/^CodelyTv\\\\Mooc\\\\.+\\\\Application/', true),
				Selector::inNamespace('/^CodelyTv\\\\Mooc\\\\.+\\\\Domain/', true),
				// Shared
				Selector::inNamespace('CodelyTv\Shared'),
			]))
			->because('mooc application can only import itself and shared');
	}

	public function test_mooc_infrastructure_should_not_import_other_contexts_beside_shared(): Rule
	{
		return PHPat::rule()
			->classes(Selector::inNamespace('CodelyTv\Mooc'))
			->shouldNotDependOn()
			->classes(Selector::inNamespace('CodelyTv'))
			->excluding(
				// Itself
				Selector::inNamespace('CodelyTv\Mooc'),
				// Shared
				Selector::inNamespace('CodelyTv\Shared'),
			);
	}
}
