<?php

namespace CodelyTv\Mooc\Notifications\Domain;

use CodelyTv\Mooc\Courses\Domain\Course;
use CodelyTv\Mooc\Courses\Domain\CourseRepository;
use CodelyTv\Mooc\Shared\Domain\Courses\CourseId;
use CodelyTv\Mooc\Shared\Domain\Videos\VideoUrl;
use CodelyTv\Mooc\Videos\Domain\VideoTitle;
use CodelyTv\Mooc\Videos\Domain\VideoType;

class SocialMediaPost
{
    private const TEXT_VIDEO_TYPE_INTERVIEW = 'una nueva entrevista';
    private const TEXT_VIDEO_TYPE_DEFAULT = 'un nuevo vídeo';
    private string $text;

    public function __construct(
        VideoType  $type,
        VideoTitle $title,
        VideoUrl   $url,
        CourseId   $courseId,
        string     $text,
    ) {
        $this->text = $text;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public static function create(
        VideoType        $type,
        VideoTitle       $title,
        VideoUrl         $url,
        CourseId         $courseId,
        CourseRepository $courseRepository,
    ):SocialMediaPost {

        switch ($type) {
            case VideoType::INTERVIEW:
                $typeText = self::TEXT_VIDEO_TYPE_INTERVIEW;
                break;
            default:
                $typeText = self::TEXT_VIDEO_TYPE_DEFAULT;
        }

        /** @var Course $course */
        $course = $courseRepository->search($courseId);

        $text = '¡Hemos publicado ' . $typeText . '! Puedes encontrar ' . $title->value() . ', correspondiente al curso ' . $course->name->value() . ', aquí: ' . $url->value();

        return new self($type, $title, $url, $courseId, $text);
    }
}