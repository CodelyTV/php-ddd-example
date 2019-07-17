<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Mooc\Videos\Application\Create;

use CodelyTv\Mooc\Videos\Application\Create\CreateVideoCommandHandler;
use CodelyTv\Mooc\Videos\Application\Create\VideoCreator;
use CodelyTv\Test\Mooc\Shared\Domain\Courses\CourseIdMother;
use CodelyTv\Test\Mooc\Shared\Domain\Videos\VideoUrlMother;
use CodelyTv\Test\Mooc\Videos\Domain\VideoCreatedDomainEventMother;
use CodelyTv\Test\Mooc\Videos\Domain\VideoIdMother;
use CodelyTv\Test\Mooc\Videos\Domain\VideoMother;
use CodelyTv\Test\Mooc\Videos\Domain\VideoTitleMother;
use CodelyTv\Test\Mooc\Videos\Domain\VideoTypeMother;
use CodelyTv\Test\Mooc\Videos\VideoModuleUnitTestCase;

final class CreateVideoTest extends VideoModuleUnitTestCase
{
    /** @var CreateVideoCommandHandler */
    private $handler;

    protected function setUp(): void
    {
        parent::setUp();

        $creator = new VideoCreator($this->repository(), $this->domainEventPublisher());

        $this->handler = new CreateVideoCommandHandler($creator);
    }

    /** @test */
    public function it_should_create_a_video(): void
    {
        $command = CreateVideoCommandMother::random();

        $id       = VideoIdMother::create($command->id());
        $type     = VideoTypeMother::create($command->type());
        $title    = VideoTitleMother::create($command->title());
        $url      = VideoUrlMother::create($command->url());
        $courseId = CourseIdMother::create($command->courseId());

        $video = VideoMother::create($id, $type, $title, $url, $courseId);

        $domainEvent = VideoCreatedDomainEventMother::create($id, $type, $title, $url, $courseId);

        $this->shouldSaveVideo($video);
        $this->shouldPublishDomainEvents($domainEvent);

        $this->dispatch($command, $this->handler);
    }
}
