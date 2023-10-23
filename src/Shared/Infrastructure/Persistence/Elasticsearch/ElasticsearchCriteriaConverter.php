<?php

declare(strict_types=1);

namespace CodelyTv\Shared\Infrastructure\Persistence\Elasticsearch;

use CodelyTv\Shared\Domain\Criteria\Criteria;

use function Lambdish\Phunctional\reduce;

final class ElasticsearchCriteriaConverter
{
	public function convert(Criteria $criteria): array
	{
		return [
			'body' => array_merge(
				['from' => $criteria->offset() ?: 0, 'size' => $criteria->limit() ?: 1000],
				$this->formatQuery($criteria),
				$this->formatSort($criteria)
			),
		];
	}

	private function formatQuery(Criteria $criteria): array
	{
		if ($criteria->hasFilters()) {
			return [
				'query' => [
					'bool' => reduce(new ElasticQueryGenerator(), $criteria->filters(), []),
				],
			];
		}

		return [];
	}

	private function formatSort(Criteria $criteria): array
	{
		if ($criteria->hasOrder()) {
			$order = $criteria->order();

			return [
				'sort' => [
					$order->orderBy()->value() => [
						'order' => $order->orderType()->value,
					],
				],
			];
		}

		return [];
	}
}
