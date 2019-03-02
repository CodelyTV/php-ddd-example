<?php

declare(strict_types = 1);

namespace CodelyTv\Shared\Infrastructure\Api\EventSubscriber;

use CodelyTv\Shared\Infrastructure\Api\Exception\ApiExceptionsHttpStatusCodeMapping;
use Exception;
use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpKernel\KernelEvents;

final class ApiExceptionLoggerSubscriber implements EventSubscriberInterface
{
    private $logger;
    private $exceptionHandler;

    public function __construct(LoggerInterface $logger, ApiExceptionsHttpStatusCodeMapping $exceptionHandler)
    {
        $this->logger           = $logger;
        $this->exceptionHandler = $exceptionHandler;
    }

    public static function getSubscribedEvents(): array
    {
        return [KernelEvents::EXCEPTION => ['onKernelException', 1]];
    }

    public function onKernelException(GetResponseForExceptionEvent $event): void
    {
        $exception = $event->getException();

        $this->logException(
            $exception,
            sprintf(
                'Uncaught PHP Exception %s: "%s" at %s line %s',
                get_class($exception),
                $exception->getMessage(),
                $exception->getFile(),
                $exception->getLine()
            )
        );
    }

    protected function logException(Exception $exception, $message): void
    {
        $level = $this->logLevel($this->exceptionStatusCode($exception));

        $this->logger->log($level, $message, ['exception' => $exception]);
    }

    protected function exceptionStatusCode(Exception $exception)
    {
        $statusCode     = 500;
        $exceptionClass = get_class($exception);

        if ($this->exceptionHandler->exists($exceptionClass)) {
            $statusCode = $this->exceptionHandler->getStatusCode($exceptionClass);
        }

        return $statusCode;
    }

    private function logLevel($statusCode): string
    {
        return $statusCode >= 500 ? LogLevel::CRITICAL : LogLevel::ERROR;
    }
}
