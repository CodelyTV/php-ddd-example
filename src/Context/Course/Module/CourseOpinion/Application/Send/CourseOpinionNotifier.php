<?php

declare(strict_types=1);

namespace CodelyTv\Context\Course\Module\CourseOpinion\Application\Send;

use CodelyTv\Context\Course\Module\CourseOpinion\Domain\Notifier\CourseOpinionNotifier as Notifier;
use CodelyTv\Context\Course\Module\CourseOpinion\Domain\ValueObject\NotificationText;

final class CourseOpinionNotifier
{
    private $notifier;

    public function __construct(Notifier $notifier)
    {
        $this->notifier = $notifier;
    }

    public function notify(NotificationText $text): void
    {
        $this->notifier->notify($text);
    }
}
