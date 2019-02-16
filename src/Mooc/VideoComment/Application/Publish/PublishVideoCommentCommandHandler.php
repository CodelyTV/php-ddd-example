<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\VideoComment\Application\Publish;

use CodelyTv\Mooc\Video\Domain\VideoId;
use CodelyTv\Mooc\VideoComment\Contract\PublishVideoCommentCommand;
use CodelyTv\Mooc\VideoComment\Domain\VideoCommentContent;
use CodelyTv\Mooc\VideoComment\Domain\VideoCommentId;

final class PublishVideoCommentCommandHandler
{
    private $publisher;

    public function __construct(VideoCommentPublisher $publisher)
    {
        $this->publisher = $publisher;
    }

    public function __invoke(PublishVideoCommentCommand $command)
    {
        $id      = new VideoCommentId($command->id());
        $videoId = new VideoId($command->videoId());
        $content = new VideoCommentContent($command->content());

        $this->publisher->publish($id, $videoId, $content);
    }
}
