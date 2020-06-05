<?php

declare(strict_types = 1);

namespace CodelyTv\Tests\Mooc\Courses\Infrastructure\Symfony\Mailer;

use CodelyTv\Mooc\Courses\Infrastructure\Symfony\Mailer\SwiftCourseGenerationNotificator;
use CodelyTv\Tests\Mooc\Courses\CoursesModuleInfrastructureTestCase;
use CodelyTv\Tests\Mooc\Courses\Domain\CourseMother;

final class SwiftCourseGenerationNotificatorTest extends CoursesModuleInfrastructureTestCase
{
    /** @test */
    public function it_should_send_a_notification(): void
    {
        $course = CourseMother::random();
        $this->swiftMailer()->notifyCourseCreated($course);
    }

    private function swiftMailer(): SwiftCourseGenerationNotificator {
        return $this->service(SwiftCourseGenerationNotificator::class);
    }
}
