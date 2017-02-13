<?php

namespace CodelyTv\Api\Infrastructure\EventSubscriber;

use CodelyTv\Api\Infrastructure\Response\ApiHttpResponse;
use FOS\RestBundle\View\View;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use Symfony\Component\HttpKernel\KernelEvents;

final class ApiResponseViewSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return [KernelEvents::VIEW => ['onKernelView', 200]];
    }

    public function onKernelView(GetResponseForControllerResultEvent $event)
    {
        $result = $event->getControllerResult();

        if ($result instanceof ApiHttpResponse) {
            $event->setControllerResult(new View($result->data(), $result->statusCode(), $result->headers()));
        }
    }
}
