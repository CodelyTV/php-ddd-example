<?php

namespace CodelyTv\Infrastructure\Monolog\Formatter;

use Exception;
use Monolog\Formatter\NormalizerFormatter;

class LogstashFormatter extends NormalizerFormatter
{
    public function __construct()
    {
        parent::__construct('Y-m-d\TH:i:s.uP');
    }

    public function format(array $record)
    {
        $message = $this->formatLogstash(parent::format($record));

        return $this->toJson($message) . PHP_EOL;
    }

    private function formatLogstash(array $record)
    {
        $message = [
            '@timestamp' => $record['datetime'],
            '@version'   => 1,
            'host'       => gethostname(),
            'tags'       => ['codelytv', $record['channel']],
            'message'    => $record['message'],
            'severity'   => $record['level_name'],
        ];

        if (!empty($record['extra'])) {
            foreach ($record['extra'] as $key => $val) {
                $message[$key] = $val;
            }
        }

        if (!empty($record['context'])) {
            foreach ($record['context'] as $key => $val) {
                $message[$key] = $val;
            }
        }

        $message['type'] = md5(implode('', array_keys($message)));

        return $message;
    }

    /** @param Exception $exception */
    protected function normalizeException($exception)
    {
        return [
            'class'   => get_class($exception),
            'file'    => $exception->getFile(),
            'line'    => $exception->getLine(),
            'code'    => method_exists($exception, 'errorCode') ? $exception->errorCode() : $exception->getCode(),
            'trace'   => $exception->getTraceAsString(),
            'message' => $exception->getMessage(),
        ];
    }
}
