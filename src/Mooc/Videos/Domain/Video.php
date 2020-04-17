<?php


namespace CodelyTv\Mooc\Videos\Domain;


final class Video
{
    private VideoId $id;
    private VideoTitle $title;

    public function __construct(VideoId $id, VideoTitle $title)
    {
        $this->id = $id;
        $this->title = $title;
    }

    public function id(): VideoId
    {
        return $this->id;
    }

    public function title(): VideoTitle
    {
        return $this->title;
    }

    public function changeTitle(VideoTitle $title): void
    {
        $this->title = $title;
    }

}