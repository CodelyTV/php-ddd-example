<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Context\Mooc;

use CodelyTv\Test\Infrastructure\PHPUnit\Module\ModuleFunctionalTestCase;

abstract class MoocContextFunctionalTestCase extends ModuleFunctionalTestCase
{
    protected function environmentArrangers()
    {
        return [
            $this->service('codely.mooc.infrastructure.arranger'),
        ];
    }
}
