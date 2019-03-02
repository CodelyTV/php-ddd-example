<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Shared\Infrastructure\Bus\Event;

use CodelyTv\Shared\Domain\Bus\Event\DomainEvent;

/**
 * @method string someIdentifier()
 */
final class ConstructionTestDomainEvent extends DomainEvent
{
    public static function eventName(): string
    {
        return 'construction_test';
    }

    protected function rules(): array
    {
        return [
            'someIdentifier' => ['string'],
        ];
    }
}
