<?php

declare(strict_types=1);

namespace CodelyTv\Tests\Mooc\Videos\Application\Create;

use CodelyTv\Mooc\Videos\Application\Create\VideoCreator;
use CodelyTv\Mooc\Videos\Application\Create\CreateVideoCommandHandler;
use CodelyTv\Tests\Mooc\Videos\VideosModuleUnitTestCase;
use CodelyTv\Tests\Mooc\Videos\Domain\VideoCreatedDomainEventMother;
use CodelyTv\Tests\Mooc\Videos\Domain\VideoMother;

final class CreateVideoCommandHandlerTest extends VideosModuleUnitTestCase
{
    private CreateVideoCommandHandler|null $handler;

    protected function setUp(): void
    {
        parent::setUp();

        $this->handler = new CreateVideoCommandHandler(new VideoCreator($this->repository(), $this->eventBus()));
    }

    /** @test */
    public function it_should_create_a_valid_Video(): void
    {
        $command = CreateVideoCommandMother::create();

        $Video      = VideoMother::fromRequest($command);
        $domainEvent = VideoCreatedDomainEventMother::fromVideo($Video);

        $this->shouldSave($Video);
        $this->shouldPublishDomainEvent($domainEvent);

        $this->dispatch($command, $this->handler);
    }
}
