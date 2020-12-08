<?php


namespace CodelyTv\Mooc\Courses\Application\Find;


use CodelyTv\Shared\Domain\Bus\Query\Response;

final class CourseResponse implements Response
{
    private string $id;
    private string $name;
    private string $duration;

    /**
     * CourseResponse constructor.
     * @param string $id
     * @param string $name
     * @param string $duration
     */
    public function __construct(string $id, string $name, string $duration)
    {
        $this->id = $id;
        $this->name = $name;
        $this->duration = $duration;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getDuration(): string
    {
        return $this->duration;
    }
}