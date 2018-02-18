<?php

namespace CodelyTv\Test\Infrastructure\PHPUnit\Module;

use CodelyTv\Shared\Domain\Bus\Event\DomainEvent;
use CodelyTv\Shared\Domain\Bus\Event\DomainEventPublisher;
use CodelyTv\Test\Infrastructure\Arranger\EnvironmentArranger;
use CodelyTv\Test\Infrastructure\PHPUnit\FunctionalTestCase;
use function CodelyTv\Test\assertSimilar;
use function Lambdish\Phunctional\each;

abstract class ModuleFunctionalTestCase extends FunctionalTestCase
{
    abstract protected function environmentArrangers();

    protected function setUp()
    {
        parent::setUp();

        each(
            function (EnvironmentArranger $arranger) {
                $arranger->arrange();
            },
            $this->environmentArrangers()
        );
    }

    protected function tearDown()
    {
        each(
            function (EnvironmentArranger $arranger) {
                $arranger->close();
            },
            $this->environmentArrangers()
        );

        parent::tearDown();
    }

    protected function clearUnitOfWork()
    {
        $this->service('codely.video.infrastructure.database')->clear();
    }

    protected function notify(DomainEvent $event)
    {
        $this->assertNull($this->domainEventPublisher()->publish($event));
    }

    protected function assertSimilar($expected, $actual)
    {
        assertSimilar($expected, $actual);
    }

    private function domainEventPublisher(): DomainEventPublisher
    {
        return $this->service('codely.infrastructure.domain_event_publisher');
    }
}
