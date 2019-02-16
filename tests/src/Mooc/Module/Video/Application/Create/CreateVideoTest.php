<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Mooc\Module\Video\Application\Create;

use CodelyTv\Mooc\Module\Video\Application\Create\CreateVideoCommandHandler;
use CodelyTv\Mooc\Module\Video\Application\Create\VideoCreator;
use CodelyTv\Test\Backoffice\Course\Domain\CourseIdMother;
use CodelyTv\Test\Mooc\Module\Video\Domain\VideoCreatedDomainEventMother;
use CodelyTv\Test\Mooc\Module\Video\Domain\VideoIdMother;
use CodelyTv\Test\Mooc\Module\Video\Domain\VideoMother;
use CodelyTv\Test\Mooc\Module\Video\Domain\VideoTitleMother;
use CodelyTv\Test\Mooc\Module\Video\Domain\VideoTypeMother;
use CodelyTv\Test\Mooc\Module\Video\Domain\VideoUrlMother;
use CodelyTv\Test\Mooc\Module\Video\VideoModuleUnitTestCase;

final class CreateVideoTest extends VideoModuleUnitTestCase
{
    /** @var CreateVideoCommandHandler */
    private $handler;

    protected function setUp()
    {
        parent::setUp();

        $creator = new VideoCreator($this->repository(), $this->domainEventPublisher());

        $this->handler = new CreateVideoCommandHandler($creator);
    }

    /** @test */
    public function it_should_create_a_video()
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
