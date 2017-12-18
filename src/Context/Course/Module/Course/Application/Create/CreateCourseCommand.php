<?php

namespace CodelyTv\Context\Course\Module\Course\Application\Create;

use CodelyTv\Shared\Domain\Bus\Command\Command;
use CodelyTv\Types\ValueObject\Uuid;

/**
 * CreateCourseCommand
 */
final class CreateCourseCommand extends Command
{
    /**
     * @var string
     */
    private $id;
    /**
     * @var string
     */
    private $title;
    /**
     * @var string
     */
    private $description;


    /**
     * CreateCourseCommand constructor.
     *
     * @param Uuid $commandId
     * @param string $id
     * @param string $title
     * @param string $description
     */
    public function __construct(Uuid $commandId, string $id, string $title, string $description)
    {
        parent::__construct($commandId);

        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function id(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function description(): string
    {
        return $this->description;
    }
}