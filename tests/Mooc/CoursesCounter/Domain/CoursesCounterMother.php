<?php

declare(strict_types=1);

namespace CodelyTv\Tests\Mooc\CoursesCounter\Domain;

use CodelyTv\Mooc\CoursesCounter\Domain\CoursesCounter;
use CodelyTv\Mooc\CoursesCounter\Domain\CoursesCounterId;
use CodelyTv\Mooc\CoursesCounter\Domain\CoursesCounterTotal;
use CodelyTv\Mooc\Shared\Domain\Courses\CourseId;
use CodelyTv\Tests\Mooc\Courses\Domain\CourseIdMother;
use CodelyTv\Tests\Shared\Domain\Repeater;

final class CoursesCounterMother
{
	public static function create(
		?CoursesCounterId $id = null,
		?CoursesCounterTotal $total = null,
		CourseId ...$existingCourses
	): CoursesCounter {
		return new CoursesCounter(
			$id ?? CoursesCounterIdMother::create(),
			$total ?? CoursesCounterTotalMother::create(),
			...count($existingCourses) ? $existingCourses : Repeater::random(fn (): CourseId => CourseIdMother::create())
		);
	}

	public static function withOne(CourseId $courseId): CoursesCounter
	{
		return self::create(CoursesCounterIdMother::create(), CoursesCounterTotalMother::one(), $courseId);
	}

	public static function incrementing(CoursesCounter $existingCounter, CourseId $courseId): CoursesCounter
	{
		return self::create(
			$existingCounter->id(),
			CoursesCounterTotalMother::create($existingCounter->total()->value() + 1),
			...array_merge($existingCounter->existingCourses(), [$courseId])
		);
	}
}
