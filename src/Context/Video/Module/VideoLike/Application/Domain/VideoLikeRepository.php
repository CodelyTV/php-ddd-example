<?php

namespace CodelyTv\Context\Video\Module\VideoLike\Application\Domain;

/**
 * Interface VideoLikeRepository
 * @package CodelyTv\Context\Video\Module\VideoLike\Application\Domain
 */
interface VideoLikeRepository
{
    /**
     * @param VideoLike $video
     *
     * @return mixed
     */
    public function save(VideoLike $video);

    /**
     * @param VideoLikeId $id
     *
     * @return mixed
     */
    public function search(VideoLikeId $id);

}