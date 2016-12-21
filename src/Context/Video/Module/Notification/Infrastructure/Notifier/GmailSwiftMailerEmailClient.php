<?php

namespace CodelyTv\Context\Video\Module\Notification\Infrastructure\Notifier;

use CodelyTv\Shared\Domain\EmailAddress;
use Swift_Mailer;
use Swift_Message;
use Swift_SmtpTransport;

final class GmailSwiftMailerEmailClient
{
    private $mailer;

    public function __construct(string $username, string $password)
    {
        $transport = Swift_SmtpTransport::newInstance('smtp.gmail.com', 465, 'ssl')
            ->setUsername($username)
            ->setPassword($password);

        $this->mailer = Swift_Mailer::newInstance($transport);
    }

    public function send(EmailAddress $from, EmailAddress $to, string $subject, string $body)
    {
        $message = Swift_Message::newInstance($subject)
            ->setFrom($from->value())
            ->setTo($to->value())
            ->setBody($body)
            ->setCharset('UTF-8');

        $this->mailer->send($message);
    }
}
