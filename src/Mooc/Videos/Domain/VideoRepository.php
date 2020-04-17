<?php


namespace CodelyTv\Mooc\Videos\Domain;


interface VideoRepository
{
    public function save(Video $video);

    public function search(VideoId $videoId): Video;

    public function update(Video $video): void;
}