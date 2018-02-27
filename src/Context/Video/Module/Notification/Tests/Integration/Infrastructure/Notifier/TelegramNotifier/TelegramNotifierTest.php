<?php
/**
 * Created by PhpStorm.
 * User: xabi
 * Date: 04/02/2018
 * Time: 15:05
 */

namespace CodelyTv\Context\Video\Module\Notification\Tests\Integration\Infrastructure\Notifier\TelegramNotifier;


use CodelyTv\Context\Video\Module\Notification\Domain\NotificationText;
use CodelyTv\Context\Video\Module\Notification\Domain\NotificationType;
use CodelyTv\Context\Video\Module\Notification\Infrastructure\Notifier\TelegramNotifier;
use CodelyTv\Test\PhpUnit\TestCase\FunctionalTestCase;
use CodelyTv\Test\Stub\TextStub;

class TelegramNotifierTest extends FunctionalTestCase
{
    public function test_send_notification_telegram()
    {
        $notifier = new TelegramNotifier($this->parameter('telegram_video_notification_bot_api_key'), $this->parameter('telegram_video_notification_channel_name'));
        $notificationText = new NotificationText(TextStub::random());
        $notAction = new NotificationType(NotificationType::VIDEO_CREATED);
        $notifier->notify($notificationText, $notAction);
    }
}