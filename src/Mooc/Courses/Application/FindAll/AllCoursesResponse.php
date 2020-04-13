<?php


namespace CodelyTv\Mooc\Courses\Application\FindAll;


use CodelyTv\Mooc\Courses\Domain\Courses;
use CodelyTv\Shared\Domain\Bus\Query\Response;

final class AllCoursesResponse implements Response
{
    private array $content;

    public function __construct(Courses $courses)
    {
        $iterator = $courses->getIterator();
        while ($iterator->valid()) {
            $course = $iterator->current();
            $this->content[] = [
                'id' => $course->id(),
                'name' => $course->name(),
            ];
            $iterator->next();
        }
    }

    public function toArray()
    {
        return $this->content;
    }
}