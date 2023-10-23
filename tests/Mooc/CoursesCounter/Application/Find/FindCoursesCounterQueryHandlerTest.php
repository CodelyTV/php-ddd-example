<?php

declare(strict_types=1);

namespace CodelyTv\Tests\Mooc\CoursesCounter\Application\Find;

use CodelyTv\Mooc\CoursesCounter\Application\Find\CoursesCounterFinder;
use CodelyTv\Mooc\CoursesCounter\Application\Find\FindCoursesCounterQuery;
use CodelyTv\Mooc\CoursesCounter\Application\Find\FindCoursesCounterQueryHandler;
use CodelyTv\Mooc\CoursesCounter\Domain\CoursesCounterNotExist;
use CodelyTv\Tests\Mooc\CoursesCounter\CoursesCounterModuleUnitTestCase;
use CodelyTv\Tests\Mooc\CoursesCounter\Domain\CoursesCounterMother;

final class FindCoursesCounterQueryHandlerTest extends CoursesCounterModuleUnitTestCase
{
	private FindCoursesCounterQueryHandler|null $handler;

	protected function setUp(): void
	{
		parent::setUp();

		$this->handler = new FindCoursesCounterQueryHandler(new CoursesCounterFinder($this->repository()));
	}

	/** @test */
	public function it_should_find_an_existing_courses_counter(): void
	{
		$counter = CoursesCounterMother::create();
		$query = new FindCoursesCounterQuery();
		$response = CoursesCounterResponseMother::create($counter->total());

		$this->shouldSearch($counter);

		$this->assertAskResponse($response, $query, $this->handler);
	}

	/** @test */
	public function it_should_throw_an_exception_when_courses_counter_does_not_exists(): void
	{
		$query = new FindCoursesCounterQuery();

		$this->shouldSearch(null);

		$this->assertAskThrowsException(CoursesCounterNotExist::class, $query, $this->handler);
	}
}
