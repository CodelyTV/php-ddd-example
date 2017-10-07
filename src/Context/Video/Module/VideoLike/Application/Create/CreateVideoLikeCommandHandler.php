<?php

namespace CodelyTv\Context\Video\Module\VideoLike\Application\Create;

use CodelyTv\Context\Video\Module\User\Domain\UserId;
use CodelyTv\Context\Video\Module\Video\Domain\VideoId;
use CodelyTv\Context\Video\Module\VideoLike\Application\Domain\VideoLikeId;

/**
 * CreateVideoLikeCommandHandler
 */
final class CreateVideoLikeCommandHandler
{
    /**
     * @var VideoLikeCreator
     */
    private $creator;

    /**
     * CreateVideoLikeCommandHandler constructor.
     *
     * @param VideoLikeCreator $creator
     */
    public function __construct(VideoLikeCreator $creator)
    {
        $this->creator = $creator;
    }

    public function __invoke(CreateVideoLikeCommand $command)
    {
        $id = new VideoLikeId($command->videoLikeId());
        $userId = new UserId($command->userId());
        $videoId = new VideoId($command->videoId());

        $this->creator->create($id, $userId, $videoId);
    }

}