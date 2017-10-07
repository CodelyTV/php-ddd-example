<?php

namespace CodelyTv\Context\Video\Module\VideoLike\Application\Domain;

use CodelyTv\Context\Video\Module\User\Domain\UserId;
use CodelyTv\Context\Video\Module\Video\Domain\VideoId;
use CodelyTv\Types\Aggregate\AggregateRoot;

/**
 * VideoLike
 */
final class VideoLike extends AggregateRoot
{

    /**
     * @var VideoLikeId
     */
    private $id;
    /**
     * @var UserId
     */
    private $userId;
    /**
     * @var VideoId
     */
    private $videoId;

    private function __construct(VideoLikeId $id, UserId $userId, VideoId $videoId)
    {

        $this->id = $id;
        $this->userId = $userId;
        $this->videoId = $videoId;
    }

    public static function like(VideoLikeId $id, UserId $userId, VideoId $videoId)
    {
        $videoLike = new self($id, $userId, $videoId);

        $videoLike->record(
            new VideoLikeCreatedDomainEvent(
                $id,
                [
                    'id' => $id->value(),
                    'userId' => $userId->value(),
                    'videoId' => $videoId->value(),
                ]
            )
        );

        return $videoLike;
    }

    /**
     * @return VideoLikeId
     */
    public function id(): VideoLikeId
    {
        return $this->id;
    }

    /**
     * @return UserId
     */
    public function userId(): UserId
    {
        return $this->userId;
    }

    /**
     * @return VideoId
     */
    public function videoId(): VideoId
    {
        return $this->videoId;
    }

}