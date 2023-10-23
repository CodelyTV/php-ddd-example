<?php

declare(strict_types=1);

namespace CodelyTv\Backoffice\Courses\Application\SearchByCriteria;

use CodelyTv\Backoffice\Courses\Application\BackofficeCourseResponse;
use CodelyTv\Backoffice\Courses\Application\BackofficeCoursesResponse;
use CodelyTv\Backoffice\Courses\Domain\BackofficeCourse;
use CodelyTv\Backoffice\Courses\Domain\BackofficeCourseRepository;
use CodelyTv\Shared\Domain\Criteria\Criteria;
use CodelyTv\Shared\Domain\Criteria\Filters;
use CodelyTv\Shared\Domain\Criteria\Order;

use function Lambdish\Phunctional\map;

final readonly class BackofficeCoursesByCriteriaSearcher
{
	public function __construct(private BackofficeCourseRepository $repository) {}

	public function search(Filters $filters, Order $order, ?int $limit, ?int $offset): BackofficeCoursesResponse
	{
		$criteria = new Criteria($filters, $order, $offset, $limit);

		return new BackofficeCoursesResponse(...map($this->toResponse(), $this->repository->matching($criteria)));
	}

	private function toResponse(): callable
	{
		return static fn (BackofficeCourse $course): BackofficeCourseResponse => new BackofficeCourseResponse(
			$course->id(),
			$course->name(),
			$course->duration()
		);
	}
}
