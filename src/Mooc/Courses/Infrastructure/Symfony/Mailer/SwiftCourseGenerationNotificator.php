<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\Courses\Infrastructure\Symfony\Mailer;

use CodelyTv\Mooc\Courses\Domain\Course;
use CodelyTv\Mooc\Courses\Domain\CourseGenerationNotificator;
use Swift_Mailer;


class SwiftCourseGenerationNotificator implements CourseGenerationNotificator {
    private Swift_Mailer $mailer;
    private const TO_EMAIL_ADDRESS = 'mbertamini@tuenti.com';

    /**
     * SwiftCourseGenerationNotificator constructor.
     */
    public function __construct(Swift_Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public function notifyCourseCreated(Course $course): void
    {
        $message = (new \Swift_Message('New course!'))
            ->setFrom('send@example.com')
            ->setTo(self::TO_EMAIL_ADDRESS)
            ->setBody("A new course {$course->name()} Has been added!",
                'text/html'
            );

        $this->mailer->send($message);
    }
}