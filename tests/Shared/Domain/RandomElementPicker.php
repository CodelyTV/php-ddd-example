<?php

declare(strict_types=1);

namespace CodelyTv\Tests\Shared\Domain;

final class RandomElementPicker
{
    /**
     * @template T
     *
     * @psalm-param T ...$elements
     *
     * @psalm-return T
     */
    public static function from(mixed ...$elements): mixed
    {
        /** @var T $randomElement */
        $randomElement = MotherCreator::random()->randomElement($elements);

        return $randomElement;
    }
}
