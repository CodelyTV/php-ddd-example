<?php

declare(strict_types=1);

namespace CodelyTv\Tests\Backoffice\Courses\Infrastructure\Persistence;

use CodelyTv\Tests\Backoffice\Courses\BackofficeCoursesModuleInfrastructureTestCase;
use CodelyTv\Tests\Backoffice\Courses\Domain\BackofficeCourseCriteriaMother;
use CodelyTv\Tests\Backoffice\Courses\Domain\BackofficeCourseMother;
use CodelyTv\Tests\Shared\Domain\Criteria\CriteriaMother;

final class ElasticsearchBackofficeCourseRepositoryTest extends BackofficeCoursesModuleInfrastructureTestCase
{
	/** @test */
	public function it_should_save_a_valid_course(): void
	{
		$this->elasticRepository()->save(BackofficeCourseMother::create());
	}

	/** @test */
	public function it_should_search_all_existing_courses(): void
	{
		$existingCourse = BackofficeCourseMother::create();
		$anotherExistingCourse = BackofficeCourseMother::create();
		$existingCourses = [$existingCourse, $anotherExistingCourse];

		$this->elasticRepository()->save($existingCourse);
		$this->elasticRepository()->save($anotherExistingCourse);

		$this->eventually(fn () => $this->assertSimilar($existingCourses, $this->elasticRepository()->searchAll()));
	}

	/** @test */
	public function it_should_search_all_existing_courses_with_an_empty_criteria(): void
	{
		$existingCourse = BackofficeCourseMother::create();
		$anotherExistingCourse = BackofficeCourseMother::create();
		$existingCourses = [$existingCourse, $anotherExistingCourse];

		$this->elasticRepository()->save($existingCourse);
		$this->elasticRepository()->save($anotherExistingCourse);

		$this->eventually(
			fn () => $this->assertSimilar($existingCourses, $this->elasticRepository()->matching(CriteriaMother::empty()))
		);
	}

	/** @test */
	public function it_should_filter_by_criteria(): void
	{
		$dddInPhpCourse = BackofficeCourseMother::create(name: 'DDD en PHP');
		$dddInJavaCourse = BackofficeCourseMother::create(name: 'DDD en Java');
		$intellijCourse = BackofficeCourseMother::create(name: 'Exprimiendo Intellij');
		$dddCourses = [$dddInPhpCourse, $dddInJavaCourse];

		$nameContainsDddCriteria = BackofficeCourseCriteriaMother::nameContains('DDD');

		$this->elasticRepository()->save($dddInJavaCourse);
		$this->elasticRepository()->save($dddInPhpCourse);
		$this->elasticRepository()->save($intellijCourse);

		$this->eventually(
			fn () => $this->assertSimilar($dddCourses, $this->elasticRepository()->matching($nameContainsDddCriteria))
		);
	}
}
