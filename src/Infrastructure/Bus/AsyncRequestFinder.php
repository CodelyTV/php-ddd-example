<?php

declare (strict_types = 1);

namespace CodelyTv\Infrastructure\Bus;

use CodelyTv\Types\ValueObject\Uuid;

/**
 * @todo Finish this implementation :)
 */
final class AsyncRequestFinder
{
    private $pendingRequestsFilePath;
    private $inProgressRequestsFilePath;
    private $processedRequestsFilePath;

    public function __construct(
        string $pendingRequestsFilePath,
        string $inProgressRequestsFilePath,
        string $processedRequestsFilePath
    ) {
        $this->pendingRequestsFilePath    = $pendingRequestsFilePath;
        $this->inProgressRequestsFilePath = $inProgressRequestsFilePath;
        $this->processedRequestsFilePath  = $processedRequestsFilePath;
    }

    public function __invoke(Uuid $requestId): AsyncRequest
    {
        // Is it in pending?

        // Is it in progress?

        // Has it been processed?

        throw new AsyncRequestNotExists($requestId);
    }
}
