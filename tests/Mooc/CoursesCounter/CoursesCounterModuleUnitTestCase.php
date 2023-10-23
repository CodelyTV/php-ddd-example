<?php

declare(strict_types=1);

namespace CodelyTv\Tests\Mooc\CoursesCounter;

use CodelyTv\Mooc\CoursesCounter\Domain\CoursesCounter;
use CodelyTv\Mooc\CoursesCounter\Domain\CoursesCounterRepository;
use CodelyTv\Tests\Shared\Infrastructure\PhpUnit\UnitTestCase;
use Mockery\MockInterface;

abstract class CoursesCounterModuleUnitTestCase extends UnitTestCase
{
	private CoursesCounterRepository|MockInterface|null $repository = null;

	protected function shouldSave(CoursesCounter $course): void
	{
		$this->repository()
			->shouldReceive('save')
			->once()
			->with($this->similarTo($course))
			->andReturnNull();
	}

	protected function shouldSearch(?CoursesCounter $counter): void
	{
		$this->repository()
			->shouldReceive('search')
			->once()
			->andReturn($counter);
	}

	protected function repository(): CoursesCounterRepository|MockInterface
	{
		return $this->repository ??= $this->mock(CoursesCounterRepository::class);
	}
}
