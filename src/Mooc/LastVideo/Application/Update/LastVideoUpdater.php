<?php

declare(strict_types=1);

namespace CodelyTv\Mooc\LastVideo\Application\Update;

use CodelyTv\Mooc\LastVideo\Domain\LastVideo;
use CodelyTv\Mooc\LastVideo\Domain\LastVideoCreatedAt;
use CodelyTv\Mooc\LastVideo\Domain\LastVideoId;
use CodelyTv\Mooc\LastVideo\Domain\LastVideoRepository;
use CodelyTv\Mooc\LastVideo\Domain\LastVideoTitle;
use CodelyTv\Mooc\LastVideo\Domain\LastVideoType;
use CodelyTv\Mooc\LastVideo\Domain\LastVideoUrl;
use CodelyTv\Mooc\Shared\Domain\Courses\CourseId;
use CodelyTv\Mooc\Shared\Domain\Videos\VideoId;
use CodelyTv\Shared\Domain\Bus\Event\EventBus;
use CodelyTv\Shared\Domain\UuidGenerator;
use phpDocumentor\Reflection\Types\This;

final class LastVideoUpdater
{
    public function __construct(
        private readonly LastVideoRepository $repository,
        private readonly UuidGenerator $uuidGenerator,
    ) {
    }

    public function __invoke(VideoId $videoId, LastVideoType $videoType, LastVideoTitle $videoTitle, LastVideoUrl $videoUrl, CourseId $videoCourseId, LastVideoCreatedAt $videoCreatedAt): void
    {
        $lastVideo = $this->repository->search();
        $isNewLastVideo = null === $lastVideo || $lastVideo->isOutdated($videoCreatedAt);

        if (!$lastVideo) {
            $lastVideo = $this->initializeLastVideo($videoId, $videoType, $videoTitle, $videoUrl, $videoCourseId, $videoCreatedAt);
        } else {
            $lastVideo->updateVideoData($videoId, $videoType, $videoTitle, $videoUrl, $videoCourseId, $videoCreatedAt);
        }

        if ($isNewLastVideo) {
            $this->repository->save($lastVideo);
        }
    }

    private function initializeLastVideo(VideoId $videoId, LastVideoType $videoType, LastVideoTitle $videoTitle, LastVideoUrl $videoUrl, CourseId $videoCourseId, LastVideoCreatedAt $videoCreatedAt): LastVideo
    {
        return LastVideo::create(new LastVideoId($this->uuidGenerator->generate()), $videoId, $videoType, $videoTitle, $videoUrl, $videoCourseId, $videoCreatedAt);
    }
}
