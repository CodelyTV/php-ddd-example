<?php

declare(strict_types = 1);

namespace CodelyTv\Shared\Domain\Criteria;

use CodelyTv\Shared\Domain\Collection;
use function Lambdish\Phunctional\reduce;

final class Filters extends Collection
{
    protected function type(): string
    {
        return Filter::class;
    }

    public static function fromValues(array $values): self
    {
        return new self(array_map(self::filterBuilder(), $values));
    }

    public function add(Filter $filter): self
    {
        return new self(array_merge($this->items(), [$filter]));
    }

    public function filters(): array
    {
        return $this->items();
    }

    public function serialize(): string
    {
        return reduce(
            static function (string $accumulate, Filter $filter) {
                return sprintf('%s^%s', $accumulate, $filter->serialize());
            },
            $this->items(),
            ''
        );
    }

    private static function filterBuilder(): callable
    {
        return function (array $values) {
            return Filter::fromValues($values);
        };
    }
}
