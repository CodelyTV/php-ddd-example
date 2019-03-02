<?php

declare(strict_types = 1);

namespace CodelyTv\Shared\Infrastructure\Api\EventSubscriber;

use CodelyTv\Shared\Infrastructure\Api\Response\ApiHttpResponse;
use FOS\RestBundle\View\View;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use Symfony\Component\HttpKernel\KernelEvents;

final class ApiResponseViewSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return [KernelEvents::VIEW => ['onKernelView', 200]];
    }

    public function onKernelView(GetResponseForControllerResultEvent $event): void
    {
        $result = $event->getControllerResult();

        if ($result instanceof ApiHttpResponse) {
            $event->setControllerResult(new View($result->data(), $result->statusCode(), $result->headers()));
        }
    }
}
