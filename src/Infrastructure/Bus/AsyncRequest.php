<?php

declare (strict_types = 1);

namespace CodelyTv\Infrastructure\Bus;

use CodelyTv\Types\ValueObject\Uuid;

final class AsyncRequest
{
    private $requestId;
    private $status;
    private $response;

    public function __construct(Uuid $requestId, AsyncRequestStatus $status, AsyncResponse $response)
    {
        $this->requestId = $requestId;
        $this->status    = $status;
        $this->response  = $response;
    }

    public function toArray(): array
    {
        return [
            'request_id' => $this->requestId->value(),
            'status'     => $this->status->value(),
            'response'   => $this->response->values(),
        ];
    }
}
