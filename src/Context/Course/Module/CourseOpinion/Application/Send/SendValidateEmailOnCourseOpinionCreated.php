<?php

declare(strict_types=1);

namespace CodelyTv\Context\Course\Module\CourseOpinion\Application\Send;

use CodelyTv\Context\Course\Module\CourseOpinion\Domain\Event\CourseOpinionCreatedDomainEvent;
use CodelyTv\Context\Course\Module\CourseOpinion\Domain\ValueObject\NotificationText;
use Rhumsaa\Uuid\Uuid;

final class SendValidateEmailOnCourseOpinionCreated
{
    private $notifier;

    public function __construct(CourseOpinionNotifier $notifier)
    {
        $this->notifier = $notifier;
    }

    public static function subscribedTo(): array
    {
        return [CourseOpinionCreatedDomainEvent::class];
    }

    public function __invoke(CourseOpinionCreatedDomainEvent $event)
    {
        if (!empty($event->text())) {
            // TODO: absolute url

            $requestId = Uuid::uuid4()->toString();

            $html = <<<EOT
<html><body>
<p>Good news! You have a new course opinion: `{$event->text()}`.</p>
<p>If you want to publish it, click on the following button:</p>
<form action="http://localhost/opinions/{$event->aggregateId()}/publish" method="post">
<input type="hidden" name="request_id" value="$requestId">
<input type="submit" value="here">
</form>
</body></html>
EOT;

            $text = new NotificationText($html);

            $this->notifier->notify($text);
        }
    }
}
