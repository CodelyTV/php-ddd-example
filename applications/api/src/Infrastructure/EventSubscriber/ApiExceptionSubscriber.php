<?php

namespace CodelyTv\Api\Infrastructure\EventSubscriber;

use CodelyTv\Api\Infrastructure\Exception\ApiExceptionsHttpStatusCodeMapping;
use CodelyTv\Exception\DomainError;
use Exception;
use FOS\RestBundle\View\View;
use FOS\RestBundle\View\ViewHandler;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpKernel\KernelEvents;

final class ApiExceptionSubscriber implements EventSubscriberInterface
{
    private $viewHandler;
    private $exceptionHandler;

    public function __construct(ViewHandler $viewHandler, ApiExceptionsHttpStatusCodeMapping $exceptionHandler)
    {
        $this->viewHandler      = $viewHandler;
        $this->exceptionHandler = $exceptionHandler;
    }

    public static function getSubscribedEvents()
    {
        return [KernelEvents::EXCEPTION => ['onKernelException', 0]];
    }

    public function onKernelException(GetResponseForExceptionEvent $event)
    {
        $exception      = $event->getException();
        $exceptionClass = get_class($exception);

        if ($this->exceptionHandler->exists($exceptionClass)) {
            $event->setResponse($this->createResponseFromApiErrorException($exception));
        }
    }

    private function createResponseFromApiErrorException(Exception $exception)
    {
        $data = [
            'code'    => $this->getExceptionCode($exception),
            'message' => $exception->getMessage(),
        ];

        return $this->viewHandler->handle(
            View::create($data, $this->exceptionHandler->getStatusCode(get_class($exception)))
        );
    }

    private function getExceptionCode(Exception $exception)
    {
        $moduleExceptionClass = DomainError::class;

        return $exception instanceof $moduleExceptionClass ? $exception->errorCode() : $exception->getCode();
    }
}
