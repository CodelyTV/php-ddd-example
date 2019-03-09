<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\VideoComments\Application\Publish;

use CodelyTv\Mooc\VideoComments\Contract\PublishVideoCommentCommand;
use CodelyTv\Mooc\VideoComments\Domain\VideoCommentContent;
use CodelyTv\Mooc\VideoComments\Domain\VideoCommentId;
use CodelyTv\Mooc\Videos\Domain\VideoId;

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
