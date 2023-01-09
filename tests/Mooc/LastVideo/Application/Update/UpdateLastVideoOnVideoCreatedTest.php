<?php

declare(strict_types=1);

namespace CodelyTv\Tests\Mooc\LastVideo\Application\Update;

use CodelyTv\Mooc\LastVideo\Application\Update\LastVideoUpdater;
use CodelyTv\Mooc\LastVideo\Application\Update\UpdateLastVideoOnVideoCreated;
use CodelyTv\Tests\Mooc\Courses\Domain\CourseIdMother;
use CodelyTv\Tests\Mooc\LastVideo\Domain\LastVideoCreatedAtMother;
use CodelyTv\Tests\Mooc\LastVideo\Domain\LastVideoTitleMother;
use CodelyTv\Tests\Mooc\LastVideo\Domain\LastVideoTypeMother;
use CodelyTv\Tests\Mooc\LastVideo\Domain\LastVideoUrlMother;
use CodelyTv\Tests\Mooc\LastVideo\LastVideoModuleUnitTestCase;
use CodelyTv\Tests\Mooc\LastVideo\Domain\LastVideoMother;
use CodelyTv\Tests\Mooc\Videos\Domain\VideoCreatedDomainEventMother;
use CodelyTv\Tests\Mooc\Videos\Domain\VideoIdMother;

final class UpdateLastVideoOnVideoCreatedTest extends LastVideoModuleUnitTestCase
{
    private UpdateLastVideoOnVideoCreated|null $subscriber;

    protected function setUp(): void
    {
        parent::setUp();

        $this->subscriber = new UpdateLastVideoOnVideoCreated(
            new LastVideoUpdater(
                $this->repository(),
                $this->uuidGenerator()
            )
        );
    }

    /** @test */
    public function it_should_initialize_a_new_lastVideo(): void
    {
        $event = VideoCreatedDomainEventMother::create();

        $videoId     = VideoIdMother::create($event->aggregateId());
        $videoPrimitives = $event->toPrimitives();

        $videoType = LastVideoTypeMother::create($videoPrimitives['type']);
        $videoTitle = LastVideoTitleMother::create($videoPrimitives['title']);
        $videoUrl = LastVideoUrlMother::create($videoPrimitives['url']);
        $courseId = CourseIdMother::create($videoPrimitives['course_id']);
        $createAt = LastVideoCreatedAtMother::create($event->occurredOn());

        $newLastVideo  = LastVideoMother::withOne($videoId, $videoType, $videoTitle, $videoUrl, $courseId, $createAt);

        $this->shouldSearch(null);
        $this->shouldGenerateUuid($newLastVideo->id()->value());
        $this->shouldSave($newLastVideo);

        $this->notify($event, $this->subscriber);
    }

    /** @test */
    public function it_should_update_an_existing_counter(): void
    {
        $event = VideoCreatedDomainEventMother::create();

        $videoId     = VideoIdMother::create($event->aggregateId());
        $videoPrimitives = $event->toPrimitives();

        $videoType = LastVideoTypeMother::create($videoPrimitives['type']);
        $videoTitle = LastVideoTitleMother::create($videoPrimitives['title']);
        $videoUrl = LastVideoUrlMother::create($videoPrimitives['url']);
        $courseId = CourseIdMother::create($videoPrimitives['course_id']);
        $createAt = LastVideoCreatedAtMother::create($event->occurredOn());

        $existingLastVideo = LastVideoMother::create();
        $updatedLastVideo  = LastVideoMother::create($existingLastVideo->id(), $videoId, $videoType, $videoTitle, $videoUrl, $courseId, $createAt);

        $this->shouldSearch($existingLastVideo);
        $this->shouldSave($updatedLastVideo);

        $this->notify($event, $this->subscriber);
    }

    /** @test */
    public function it_should_not_update_an_already_updated_last_video(): void
    {
        $event = VideoCreatedDomainEventMother::create();

        $videoId     = VideoIdMother::create($event->aggregateId());
        $videoPrimitives = $event->toPrimitives();

        $videoType = LastVideoTypeMother::create($videoPrimitives['type']);
        $videoTitle = LastVideoTitleMother::create($videoPrimitives['title']);
        $videoUrl = LastVideoUrlMother::create($videoPrimitives['url']);
        $courseId = CourseIdMother::create($videoPrimitives['course_id']);
        $createAt = LastVideoCreatedAtMother::create($event->occurredOn());

        $existingLastVideo = LastVideoMother::withOne($videoId, $videoType, $videoTitle, $videoUrl, $courseId, $createAt);

        $this->shouldSearch($existingLastVideo);

        $this->notify($event, $this->subscriber);
    }
}
