<?php

declare(strict_types = 1);

namespace CodelyTv\Infrastructure\RabbitMQ;

use AMQPEnvelope;
use AMQPQueue;
use CodelyTv\Infrastructure\Bus\Event\DomainEventMapping;
use CodelyTv\Infrastructure\Bus\Event\Serialize\DomainEventUnserializer;
use Exception;
use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;
use function Lambdish\Phunctional\apply;
use function Lambdish\Phunctional\get;
use function Lambdish\Phunctional\pipe;

final class RabbitMQConsumer
{
    private $consumer;
    private $logger;

    public function __construct(callable $consumer, DomainEventMapping $eventMapping, LoggerInterface $logger)
    {
        $this->logger   = $logger;
        $this->consumer = pipe(new DomainEventUnserializer($eventMapping), $consumer);
    }

    public function __invoke(AMQPEnvelope $envelope, AMQPQueue $queue)
    {
        $queueName = $queue->getName();

        try {
            apply($this->consumer, [$envelope->getBody()]);

            $this->log('Message consumed', $envelope, $queueName, LogLevel::DEBUG);
        } catch (Exception $exception) {
            $level = $this->hasBeenRedeliveredTooMuch($envelope) ? LogLevel::ERROR : LogLevel::DEBUG;
            $this->log('Message consumption failed', $envelope, $queueName, $level, $exception);

            // $this->requeue($envelope, $queue, $exception);
        }

        $this->ack($envelope, $queue);
    }

    private function ack(AMQPEnvelope $envelope, AMQPQueue $queue)
    {
        try {
            $ack = $queue->ack($envelope->getDeliveryTag());

            if (false === $ack) {
                $this->log('Message has not been acknowledged', $envelope, $queue->getName(), LogLevel::ERROR);
            }
        } catch (Exception $exception) {
            $this->log('Message has not been acknowledged', $envelope, $queue->getName(), LogLevel::ERROR, $exception);
        }
    }

    private function hasBeenRedeliveredTooMuch(AMQPEnvelope $envelope)
    {
        return get('redelivery_count', $envelope->getHeaders(), 0) > 500;
    }

    private function log(
        string $message,
        AMQPEnvelope $envelope,
        string $queueName,
        string $level = LogLevel::ERROR,
        Exception $exception = null
    ) {
        $this->logger->log(
            $level,
            $message,
            [
                'envelope'  => [
                    'app_id'           => $envelope->getAppId(),
                    'body'             => $envelope->getBody(),
                    'content_encoding' => $envelope->getContentEncoding(),
                    'content_type'     => $envelope->getContentType(),
                    'correlation_id'   => $envelope->getCorrelationId(),
                    'delivery_mode'    => $envelope->getDeliveryMode(),
                    'delivery_tag'     => $envelope->getDeliveryTag(),
                    'exchange_name'    => $envelope->getExchangeName(),
                    'expiration'       => $envelope->getExpiration(),
                    'headers'          => $envelope->getHeaders(),
                    'message_id'       => $envelope->getMessageId(),
                    'priority'         => $envelope->getPriority(),
                    'reply_to'         => $envelope->getReplyTo(),
                    'routing_key'      => $envelope->getRoutingKey(),
                    'timestamp'        => $envelope->getTimeStamp(),
                    'type'             => $envelope->getType(),
                    'user_id'          => $envelope->getUserId(),
                    'is_redelivery'    => $envelope->isRedelivery(),
                ],
                'queue'     => $queueName,
                'exception' => $exception ?
                    [
                        'error' => $exception->getMessage(),
                        'file'  => $exception->getFile(),
                        'line'  => $exception->getLine(),
                        'trace' => $exception->getTraceAsString(),
                    ] :
                    null,
            ]
        );
    }
}
