<?php

declare(strict_types=1);

namespace CodelyTv\OpenFlight\Videos\Application\Create;

use CodelyTv\OpenFlight\Shared\Domain\Courses\CourseId;
use CodelyTv\OpenFlight\Shared\Domain\Videos\VideoUrl;
use CodelyTv\OpenFlight\Videos\Domain\Video;
use CodelyTv\OpenFlight\Videos\Domain\VideoId;
use CodelyTv\OpenFlight\Videos\Domain\VideoRepository;
use CodelyTv\OpenFlight\Videos\Domain\VideoTitle;
use CodelyTv\OpenFlight\Videos\Domain\VideoType;
use CodelyTv\Shared\Domain\Bus\Event\EventBus;

final class VideoCreator
{
    public function __construct(private VideoRepository $repository, private EventBus $bus)
    {
    }

    public function create(VideoId $id, VideoType $type, VideoTitle $title, VideoUrl $url, CourseId $courseId): void
    {
        $video = Video::create($id, $type, $title, $url, $courseId);

        $this->repository->save($video);

        $this->bus->publish(...$video->pullDomainEvents());
    }
}
