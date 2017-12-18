<?php

namespace CodelyTv\Context\Video\Module\VideoLike\Application\Create;

use CodelyTv\Shared\Domain\Bus\Command\Command;
use CodelyTv\Types\ValueObject\Uuid;

/**
 * CreateVideoLikeCommand
 */
final class CreateVideoLikeCommand extends Command
{
    /**
     * @var string
     */
    private $videoLikeId;
    /**
     * @var string
     */
    private $videoId;
    /**
     * @var string
     */
    private $userId;


    /**
     * CreateVideoLikeCommand constructor.
     *
     * @param Uuid $commandId
     * @param string $videoLikeId
     * @param string $videoId
     * @param string $userId
     */
    public function __construct(Uuid $commandId, string $videoLikeId, string $videoId, string $userId)
    {
        parent::__construct($commandId);

        $this->videoLikeId = $videoLikeId;
        $this->videoId = $videoId;
        $this->userId = $userId;
    }

    /**
     * @return string
     */
    public function videoLikeId(): string
    {
        return $this->videoLikeId;
    }

    /**
     * @return string
     */
    public function videoId(): string
    {
        return $this->videoId;
    }

    /**
     * @return string
     */
    public function userId(): string
    {
        return $this->userId;
    }
}