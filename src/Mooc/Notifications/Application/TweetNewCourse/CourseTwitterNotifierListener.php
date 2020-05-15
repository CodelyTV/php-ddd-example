<?php


namespace CodelyTv\Mooc\Notifications\Application\TweetNewCourse;


use CodelyTv\Mooc\Courses\Domain\CourseCreatedDomainEvent;
use CodelyTv\Mooc\Courses\Infrastructure\TwitterNotifier;

class CourseTwitterNotifierListener
{
    private TwitterNotifier $twitterNotifier;

    public function __construct(TwitterNotifier $twitterNotifier)
    {
        $this->twitterNotifier = $twitterNotifier;
    }

    public function onCourseCreated(CourseCreatedDomainEvent $event)
    {
        $this->twitterNotifier->publish([
            'status' => 'A new course called "' . $event->name() . '" has been created in #CodelyTV. Check it out!',
        ]);
    }
}