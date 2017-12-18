<?php

namespace CodelyTv\Context\Video\Module\VideoLike\Application\Create;

use CodelyTv\Context\Video\Module\User\Domain\UserId;
use CodelyTv\Context\Video\Module\Video\Domain\VideoId;
use CodelyTv\Context\Video\Module\VideoLike\Domain\VideoLike;
use CodelyTv\Context\Video\Module\VideoLike\Domain\VideoLikeId;
use CodelyTv\Context\Video\Module\VideoLike\Domain\VideoLikeRepository;
use CodelyTv\Shared\Domain\Bus\Event\DomainEventPublisher;

/**
 * VideoLikeCreator
 */
final class VideoLikeCreator
{
    /**
     * @var VideoLikeRepository
     */
    private $repository;
    /**
     * @var DomainEventPublisher
     */
    private $publisher;

    /**
     * VideoLikeCreator constructor.
     *
     * @param VideoLikeRepository $repository
     * @param DomainEventPublisher $publisher
     */
    public function __construct(VideoLikeRepository $repository, DomainEventPublisher $publisher)
    {
        $this->repository = $repository;
        $this->publisher = $publisher;
    }

    public function create(VideoLikeId $id, UserId $userId, VideoId $videoId)
    {
        $videoLike = VideoLike::like($id,$userId, $videoId);

        $this->repository->save($videoLike);

        $this->publisher->publish(...$videoLike->pullDomainEvents());
    }
}