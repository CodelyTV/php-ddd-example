<?php

declare(strict_types=1);

namespace CodelyTv\Context\Course\Module\CourseOpinion\Domain\Notifier;

use CodelyTv\Context\Course\Module\CourseOpinion\Domain\ValueObject\NotificationText;

interface CourseOpinionNotifier
{
    public function notify(NotificationText $text);
}
