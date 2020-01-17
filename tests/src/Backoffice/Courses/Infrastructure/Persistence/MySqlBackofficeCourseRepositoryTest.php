<?php

declare(strict_types = 1);

namespace CodelyTv\Tests\Backoffice\Courses\Infrastructure\Persistence;

use CodelyTv\Tests\Backoffice\Courses\BackofficeCoursesModuleInfrastructureTestCase;
use CodelyTv\Tests\Backoffice\Courses\Domain\BackofficeCourseCriteriaMother;
use CodelyTv\Tests\Backoffice\Courses\Domain\BackofficeCourseMother;
use CodelyTv\Tests\Shared\Domain\Criteria\CriteriaMother;

final class MySqlBackofficeCourseRepositoryTest extends BackofficeCoursesModuleInfrastructureTestCase
{
    /** @test */
    public function it_should_save_a_valid_course(): void
    {
        $this->repository()->save(BackofficeCourseMother::random());
    }

    /** @test */
    public function it_should_search_all_existing_courses(): void
    {
        $existingCourse        = BackofficeCourseMother::random();
        $anotherExistingCourse = BackofficeCourseMother::random();
        $existingCourses       = [$existingCourse, $anotherExistingCourse];

        $this->repository()->save($existingCourse);
        $this->repository()->save($anotherExistingCourse);

        $this->assertSimilar($existingCourses, $this->repository()->searchAll());
    }

    /** @test */
    public function it_should_search_all_existing_courses_with_an_empty_criteria(): void
    {
        $existingCourse        = BackofficeCourseMother::random();
        $anotherExistingCourse = BackofficeCourseMother::random();
        $existingCourses       = [$existingCourse, $anotherExistingCourse];

        $this->repository()->save($existingCourse);
        $this->repository()->save($anotherExistingCourse);
        $this->clearUnitOfWork();

        $this->assertSimilar($existingCourses, $this->repository()->matching(CriteriaMother::empty()));
    }

    /** @test */
    public function it_should_filter_by_criteria(): void
    {
        $dddInPhpCourse  = BackofficeCourseMother::withName('DDD en PHP');
        $dddInJavaCourse = BackofficeCourseMother::withName('DDD en Java');
        $intellijCourse  = BackofficeCourseMother::withName('Exprimiendo Intellij');
        $dddCourses      = [$dddInPhpCourse, $dddInJavaCourse];

        $nameContainsDddCriteria = BackofficeCourseCriteriaMother::nameContains('DDD');

        $this->repository()->save($dddInJavaCourse);
        $this->repository()->save($dddInPhpCourse);
        $this->repository()->save($intellijCourse);
        $this->clearUnitOfWork();

        $this->assertSimilar($dddCourses, $this->repository()->matching($nameContainsDddCriteria));
    }
}
