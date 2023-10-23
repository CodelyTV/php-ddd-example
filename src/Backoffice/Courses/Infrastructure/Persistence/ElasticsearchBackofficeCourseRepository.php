<?php

declare(strict_types=1);

namespace CodelyTv\Backoffice\Courses\Infrastructure\Persistence;

use CodelyTv\Backoffice\Courses\Domain\BackofficeCourse;
use CodelyTv\Backoffice\Courses\Domain\BackofficeCourseRepository;
use CodelyTv\Shared\Domain\Criteria\Criteria;
use CodelyTv\Shared\Infrastructure\Persistence\Elasticsearch\ElasticsearchRepository;

use function Lambdish\Phunctional\map;

final class ElasticsearchBackofficeCourseRepository extends ElasticsearchRepository implements BackofficeCourseRepository
{
	public function save(BackofficeCourse $course): void
	{
		$this->persist($course->id(), $course->toPrimitives());
	}

	public function searchAll(): array
	{
		return map($this->toCourse(), $this->searchAllInElastic());
	}

	public function matching(Criteria $criteria): array
	{
		return map($this->toCourse(), $this->searchByCriteria($criteria));
	}

	protected function aggregateName(): string
	{
		return 'courses';
	}

	private function toCourse(): callable
	{
		return static fn (array $primitives): BackofficeCourse => BackofficeCourse::fromPrimitives($primitives);
	}
}
