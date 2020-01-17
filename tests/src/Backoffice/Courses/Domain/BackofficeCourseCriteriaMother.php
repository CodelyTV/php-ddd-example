<?php

declare(strict_types = 1);

namespace CodelyTv\Tests\Backoffice\Courses\Domain;

use CodelyTv\Shared\Domain\Criteria\Criteria;
use CodelyTv\Tests\Shared\Domain\Criteria\CriteriaMother;
use CodelyTv\Tests\Shared\Domain\Criteria\FilterMother;
use CodelyTv\Tests\Shared\Domain\Criteria\FiltersMother;
use CodelyTv\Tests\Shared\Domain\Criteria\OrderMother;

final class BackofficeCourseCriteriaMother
{
    public static function nameContains(string $text): Criteria
    {
        return CriteriaMother::create(
            FiltersMother::createOne(
                FilterMother::fromValues(
                    [
                        'field'    => 'name',
                        'operator' => 'CONTAINS',
                        'value'    => $text,
                    ]
                )
            )
        );
    }
}
