<?php

declare(strict_types=1);

namespace CodelyTv\Tests\Shared\Infrastructure\PhpUnit;

use CodelyTv\Tests\Shared\Domain\TestUtils;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Throwable;

abstract class InfrastructureTestCase extends KernelTestCase
{
	abstract protected function kernelClass(): string;

	protected function setUp(): void
	{
		$_SERVER['KERNEL_CLASS'] = $this->kernelClass();

		self::bootKernel(['environment' => 'test']);

		parent::setUp();
	}

	protected function assertSimilar(mixed $expected, mixed $actual): void
	{
		TestUtils::assertSimilar($expected, $actual);
	}

	protected function service(string $id): mixed
	{
		return self::getContainer()->get($id);
	}

	protected function parameter(string $parameter): mixed
	{
		return self::getContainer()->getParameter($parameter);
	}

	protected function clearUnitOfWork(): void
	{
		$this->service(EntityManager::class)->clear();
	}

	/** @param int<0, max> $timeToWaitOnErrorInSeconds */
	protected function eventually(
		callable $fn,
		int $totalRetries = 3,
		int $timeToWaitOnErrorInSeconds = 1,
		int $attempt = 0
	): void {
		try {
			$fn();
		} catch (Throwable $error) {
			if ($totalRetries === $attempt) {
				throw $error;
			}

			sleep($timeToWaitOnErrorInSeconds);

			$this->eventually($fn, $totalRetries, $timeToWaitOnErrorInSeconds, $attempt + 1);
		}
	}
}
