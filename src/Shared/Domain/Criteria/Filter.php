<?php

declare(strict_types=1);

namespace CodelyTv\Shared\Domain\Criteria;

final readonly class Filter
{
	public function __construct(
		private FilterField $field,
		private FilterOperator $operator,
		private FilterValue $value
	) {}

	public static function fromValues(array $values): self
	{
		return new self(
			new FilterField($values['field']),
			FilterOperator::from($values['operator']),
			new FilterValue($values['value'])
		);
	}

	public function field(): FilterField
	{
		return $this->field;
	}

	public function operator(): FilterOperator
	{
		return $this->operator;
	}

	public function value(): FilterValue
	{
		return $this->value;
	}

	public function serialize(): string
	{
		return sprintf('%s.%s.%s', $this->field->value(), $this->operator->value, $this->value->value());
	}
}
