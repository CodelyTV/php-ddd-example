<?php

namespace CodelyTv\Context\Meetup\Test\PhpUnit;

use CodelyTv\Test\PhpUnit\TestCase\Module\ModuleFunctionalTestCase;

abstract class MeetupContextFunctionalTestCase extends ModuleFunctionalTestCase
{
    protected function environmentArrangers()
    {
        return [
            $this->service('codely.meetup.infrastructure.arranger'),
        ];
    }
}
