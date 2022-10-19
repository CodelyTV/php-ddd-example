<?php

declare(strict_types=1);

namespace CodelyTv\Mooc\Notifications\Application\PublishInSocialMediaOnNewVideo;

use CodelyTv\Mooc\Courses\Domain\CourseRepository;
use CodelyTv\Mooc\Notifications\Domain\SocialMediaPost;
use CodelyTv\Mooc\Notifications\Domain\SocialMediaRepository;
use CodelyTv\Mooc\Shared\Domain\Courses\CourseId;
use CodelyTv\Mooc\Shared\Domain\Videos\VideoUrl;
use CodelyTv\Mooc\Videos\Domain\VideoTitle;
use CodelyTv\Mooc\Videos\Domain\VideoType;

final class PublishInSocialMediaOnNewVideo
{
    public function __construct(
        private readonly SocialMediaRepository $socialMediaRepository,
    )
    {
    }

    public function create(
        VideoType        $type,
        VideoTitle       $title,
        VideoUrl         $url,
        CourseId         $courseId,
        CourseRepository $courseRepository,
    ): void
    {
        $post = SocialMediaPost::create($type, $title, $url, $courseId, $courseRepository);

        $response = $this->socialMediaRepository->newPost($post);
    }
}
