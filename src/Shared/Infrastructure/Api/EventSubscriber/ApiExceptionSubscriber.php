<?php

declare(strict_types = 1);

namespace CodelyTv\Shared\Infrastructure\Api\EventSubscriber;

use CodelyTv\Shared\Domain\DomainError;
use CodelyTv\Shared\Infrastructure\Api\Exception\ApiExceptionsHttpStatusCodeMapping;
use Exception;
use FOS\RestBundle\View\View;
use FOS\RestBundle\View\ViewHandlerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpKernel\KernelEvents;

final class ApiExceptionSubscriber implements EventSubscriberInterface
{
    private $viewHandler;
    private $exceptionHandler;

    public function __construct(ViewHandlerInterface $viewHandler, ApiExceptionsHttpStatusCodeMapping $exceptionHandler)
    {
        $this->viewHandler      = $viewHandler;
        $this->exceptionHandler = $exceptionHandler;
    }

    public static function getSubscribedEvents(): array
    {
        return [KernelEvents::EXCEPTION => ['onKernelException', 0]];
    }

    public function onKernelException(GetResponseForExceptionEvent $event): void
    {
        $exception      = $event->getException();
        $exceptionClass = get_class($exception);

        if ($this->exceptionHandler->exists($exceptionClass)) {
            $event->setResponse($this->createResponseFromApiErrorException($exception));
        }
    }

    private function createResponseFromApiErrorException(Exception $exception): Response
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

        return $exception instanceof $moduleExceptionClass ? $this->domainErrorCode($exception) : $exception->getCode();
    }

    private function domainErrorCode($error): string
    {
        /** @var DomainError $error */
        return $error->errorCode();
    }
}
