<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\Module\VideoComment\Application\Publish;

use CodelyTv\Mooc\Module\Video\Domain\VideoId;
use CodelyTv\Mooc\Module\VideoComment\Contract\PublishVideoCommentCommand;
use CodelyTv\Mooc\Module\VideoComment\Domain\VideoCommentContent;
use CodelyTv\Mooc\Module\VideoComment\Domain\VideoCommentId;

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
