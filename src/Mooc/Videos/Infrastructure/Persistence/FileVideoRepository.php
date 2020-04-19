<?php


namespace CodelyTv\Mooc\Videos\Infrastructure\Persistence;


use CodelyTv\Mooc\Videos\Domain\Video;
use CodelyTv\Mooc\Videos\Domain\VideoId;
use CodelyTv\Mooc\Videos\Domain\VideoRepository;

final class FileVideoRepository implements VideoRepository
{

    private string $filesDirectory;

    public function __construct(string $filesDirectory)
    {
        $this->filesDirectory = $filesDirectory . '/videos';
    }


    public function save(Video $video): void
    {
        file_put_contents($this->fileName($video->id()), serialize($video));
    }

    public function search(VideoId $videoId): ?Video
    {
        $videos = $this->getAllVideos();
        return $videos[$videoId->value()] ?? null;
    }

    public function update(Video $video): void
    {
        if (!array_key_exists($video->id()->value(), $this->getAllVideos())) {
            return;
        }

        file_put_contents($this->fileName($video->id()), serialize($video));
    }

    private function fileName(VideoId $id): string
    {
        return sprintf('%s.%s.repo', $this->filesDirectory, $id->value());
    }

    private function getAllVideos(): array
    {
        $files = glob($this->filesDirectory . '*.repo');
        $videos = [];
        foreach ($files as $file) {
            $video = unserialize(file_get_contents($file));
            $videos[$video->id()->value()] = $video;
        }
        return $videos;
    }
}