<?php


namespace CodelyTv\Backoffice\Videos\Domain;


use CodelyTv\Shared\Domain\Aggregate\AggregateRoot;

final class Video extends AggregateRoot
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

    public function updateTitle(VideoTitle $title): void
    {
        $this->title = $title;
        $this->record(new VideoTitleUpdatedDomainEvent($this->id->value(), $this->title->value()));
    }

}