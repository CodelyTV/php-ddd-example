<?php


namespace CodelyTv\Backoffice\Videos\Application\Update;


class VideoTitleUpdaterRequest
{
    private string $videoId;
    private string $videoTitle;

    public function __construct(string $videoId, string $videoTitle)
    {
        $this->videoId = $videoId;
        $this->videoTitle = $videoTitle;
    }

    public function videoId(): string
    {
        return $this->videoId;
    }

    public function videoTitle(): string
    {
        return $this->videoTitle;
    }


}