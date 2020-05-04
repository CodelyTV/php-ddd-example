<?php


namespace CodelyTv\Mooc\Shared\Infrastructure\Filesystem;

use CodelyTv\Mooc\Shared\Domain\Logger;

class FilesystemLogger extends Logger
{
    private string $folder;
    private string $filename;

    /**
     * FilesystemLogger constructor.
     * @param string $folder
     * @param string $filename
     */
    public function __construct(string $folder, string $filename)
    {
        if(! is_dir($folder)) {
            throw new \InvalidArgumentException("Incorrect log folder: ".$folder);
        }

        $this->folder = $folder;
        $this->filename = $filename;
    }
    /**
     * Logs with an arbitrary level.
     *
     * @param mixed $level
     * @param string $message
     * @param array $context
     * @return void
     */
    public function log($level, $message, array $context = array())
    {
        $level = parent::standardize($level, $this);
        $this->write($level. ": ". $message);
    }

    private function write($message)
    {
        $message = date('M d H:i:s ') . ': ' . $message;
        file_put_contents(
            $this->folder."/".$this->filename,
            $message
        );
    }


}