<?php

namespace CodelyTv\Infrastructure\Doctrine;

use CodelyTv\Shared\Domain\Criteria\Criteria;
use CodelyTv\Shared\Domain\Criteria\Filter;
use CodelyTv\Shared\Domain\Criteria\FilterField;
use CodelyTv\Shared\Domain\Criteria\OrderBy;
use Doctrine\Common\Collections\Criteria as DoctrineCriteria;
use Doctrine\Common\Collections\Expr\Comparison;
use Doctrine\Common\Collections\Expr\CompositeExpression;

final class DoctrineCriteriaConverter
{
    private $criteria;
    private $fieldsMap;
    private $hydrators;

    public function __construct(Criteria $criteria, array $fieldsMap = [], array $hydrators = [])
    {
        $this->criteria  = $criteria;
        $this->fieldsMap = $fieldsMap;
        $this->hydrators = $hydrators;
    }

    public static function convert(Criteria $criteria, array $fieldsMap = [], array $hydrators = [])
    {
        $converter = new self($criteria, $fieldsMap, $hydrators);

        return $converter->convertToDoctrineCriteria();
    }

    public static function convertToCount(Criteria $criteria, array $fieldsMap = [], array $hydrators = [])
    {
        $converter = new self($criteria, $fieldsMap, $hydrators);

        return $converter->convertToDoctrineCriteriaToCount();
    }

    private function convertToDoctrineCriteria()
    {
        return new DoctrineCriteria(
            $this->buildExpression($this->criteria),
            $this->formatOrder($this->criteria),
            $this->criteria->offset(),
            $this->criteria->limit()
        );
    }

    private function convertToDoctrineCriteriaToCount()
    {
        return new DoctrineCriteria($this->buildExpression($this->criteria), $this->formatOrder($this->criteria));
    }

    private function buildExpression(Criteria $criteria)
    {
        if ($criteria->hasFilters()) {
            return new CompositeExpression(
                CompositeExpression::TYPE_AND,
                array_map($this->buildComparison(), $criteria->plainFilters())
            );
        }

        return null;
    }

    private function buildComparison()
    {
        return function (Filter $filter) {
            $field = $this->mapFieldValue($filter->field());
            $value = $this->existsHydratorFor($field) ?
                $this->hydrate($field, $filter->value()->value()) :
                $filter->value()->value();

            return new Comparison($field, $filter->operator()->value(), $value);
        };
    }

    private function mapFieldValue(FilterField $field)
    {
        return array_key_exists($field->value(), $this->fieldsMap) ?
            $this->fieldsMap[$field->value()] :
            $field->value();
    }

    private function formatOrder(Criteria $criteria)
    {
        if (!$criteria->hasOrder()) {
            return null;
        }

        return [$this->mapOrderBy($criteria->order()->orderBy()) => $criteria->order()->orderType()];
    }

    private function mapOrderBy(OrderBy $field)
    {
        return array_key_exists($field->value(), $this->fieldsMap) ?
            $this->fieldsMap[$field->value()] :
            $field->value();
    }

    private function existsHydratorFor($field)
    {
        return array_key_exists($field, $this->hydrators);
    }

    private function hydrate($field, $value)
    {
        return $this->hydrators[$field]($value);
    }
}
