<?php

declare(strict_types=1);

namespace CodelyTv\Mooc\Videos\Application\Create;

use CodelyTv\Mooc\Courses\Domain\CourseRepository;
use CodelyTv\Mooc\Notifications\Domain\SocialMediaPost;
use CodelyTv\Mooc\Notifications\Domain\SocialMediaRepository;
use CodelyTv\Mooc\Shared\Domain\Courses\CourseId;
use CodelyTv\Mooc\Shared\Domain\Videos\VideoUrl;
use CodelyTv\Mooc\Videos\Domain\Video;
use CodelyTv\Mooc\Videos\Domain\VideoId;
use CodelyTv\Mooc\Videos\Domain\VideoRepository;
use CodelyTv\Mooc\Videos\Domain\VideoTitle;
use CodelyTv\Mooc\Videos\Domain\VideoType;
use CodelyTv\Shared\Domain\Bus\Event\EventBus;

final class VideoCreator
{
    public function __construct(
        private readonly VideoRepository $repository,
        private readonly EventBus $bus,
        private readonly SocialMediaRepository $socialMediaRepository,
        private readonly SocialMediaPost $socialMediaPost,
        private readonly CourseRepository $courseRepository,
    )
    {
    }

    public function create(VideoId $id, VideoType $type, VideoTitle $title, VideoUrl $url, CourseId $courseId): void
    {
        $video = Video::create($id, $type, $title, $url, $courseId);

        $this->repository->save($video);

        $post = $this->socialMediaPost->create($type, $title, $url, $courseId, $this->courseRepository);
        $this->socialMediaRepository->newPost($post);

        $this->bus->publish(...$video->pullDomainEvents());
    }
}
