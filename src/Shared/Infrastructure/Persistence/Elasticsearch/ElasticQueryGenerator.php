<?php

declare(strict_types=1);

namespace CodelyTv\Shared\Infrastructure\Persistence\Elasticsearch;

use CodelyTv\Shared\Domain\Criteria\Filter;
use CodelyTv\Shared\Domain\Criteria\FilterOperator;

final class ElasticQueryGenerator
{
	private const MUST_TYPE = 'must';
	private const MUST_NOT_TYPE = 'must_not';
	private const TERM_TERM = 'term';
	private const TERM_RANGE = 'range';
	private const TERM_WILDCARD = 'wildcard';

	private static array $mustNotFields = [FilterOperator::NOT_EQUAL, FilterOperator::NOT_CONTAINS];

	public function __invoke(array $query, Filter $filter): array
	{
		$type = $this->typeFor($filter->operator());
		$termLevel = $this->termLevelFor($filter->operator());
		$valueTemplate = $filter->operator()->isContaining() ? '*%s*' : '%s';

		return array_merge_recursive(
			$query,
			[
				$type => [
					$termLevel => [
						$filter->field()->value() => sprintf($valueTemplate, strtolower($filter->value()->value())),
					],
				],
			]
		);
	}

	private function typeFor(FilterOperator $operator): string
	{
		return in_array($operator->value, self::$mustNotFields, true) ? self::MUST_NOT_TYPE : self::MUST_TYPE;
	}

	private function termLevelFor(FilterOperator $operator): string
	{
		return match ($operator) {
			FilterOperator::EQUAL => self::TERM_TERM,
			FilterOperator::NOT_EQUAL => '!=',
			FilterOperator::GT, FilterOperator::LT => self::TERM_RANGE,
			FilterOperator::CONTAINS, FilterOperator::NOT_CONTAINS => self::TERM_WILDCARD,
		};
	}
}
