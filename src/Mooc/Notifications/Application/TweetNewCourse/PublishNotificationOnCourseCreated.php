<?php
declare(strict_types=1);


namespace CodelyTv\Mooc\Notifications\Application\TweetNewCourse;


use CodelyTv\Mooc\Courses\Domain\CourseCreatedDomainEvent;
use CodelyTv\Mooc\Courses\Infrastructure\TwitterNotification;
use CodelyTv\Mooc\Courses\Infrastructure\TwitterNotifier;

final class PublishNotificationOnCourseCreated
{
    private TwitterNotifier $twitterNotifier;

    public function __construct(TwitterNotifier $twitterNotifier)
    {
        $this->twitterNotifier = $twitterNotifier;
    }

    public function onCourseCreated(CourseCreatedDomainEvent $event): void
    {
        $notification = new TwitterNotification(
            'A new course called "' . $event->name() . '" has been created in #CodelyTV. Check it out!'
        );
        $this->twitterNotifier->publish($notification);
    }
}