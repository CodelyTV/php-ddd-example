<?php

declare(strict_types=1);

namespace CodelyTv\Context\Course\Module\CourseOpinion\Infrastructure\Notifier;

use CodelyTv\Context\Course\Module\CourseOpinion\Domain\Notifier\CourseOpinionNotifier;
use CodelyTv\Context\Course\Module\CourseOpinion\Domain\ValueObject\NotificationText;
use Swift_Mailer;
use Swift_Message;
use Swift_SmtpTransport;

final class EmailCourseOpinionNotifier implements CourseOpinionNotifier
{
    private const NOTIFY_SUBJECT = 'Breaking news!! New course opinion!!';
    private const NOTIFY_FROM    = 'notifications@codely.tv';
    private const NOTIFY_TO      = 'javier@signaturit.com';

    private $mailer;

    public function __construct(string $smtp, int $port, string $security, string $username, string $password)
    {
        $transport = Swift_SmtpTransport::newInstance($smtp, $port, $security)
            ->setUsername($username)
            ->setPassword($password);

        $this->mailer = Swift_Mailer::newInstance($transport);
    }

    public function notify(NotificationText $text): void
    {
        $message = Swift_Message::newInstance(self::NOTIFY_SUBJECT)
            ->setFrom(self::NOTIFY_FROM)
            ->setTo(self::NOTIFY_TO)
            ->setBody($text->value(), 'text/html');

        $this->mailer->send($message);
    }
}
