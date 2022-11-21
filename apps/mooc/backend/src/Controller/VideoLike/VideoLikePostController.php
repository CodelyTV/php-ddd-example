<?php

declare(strict_types=1);

namespace CodelyTv\Apps\Mooc\Backend\Controller\VideoLike;

use CodelyTv\Mooc\VideoLike\Application\Create\CreateVideoLikeCommand;
use CodelyTv\Shared\Domain\ValueObject\Uuid;
use CodelyTv\Shared\Infrastructure\Symfony\ApiController;
use CodelyTv\Shared\Infrastructure\Symfony\ApiHttpCreatedResponse;
use Faker\Provider\Uuid as UuidFactory;
use Symfony\Component\HttpFoundation\Request;

final class VideoLikePostController extends ApiController
{
    protected function exceptions(): array
    {
        return [];
    }

    public function __invoke(Request $request)
    {
        /** @var CreateVideoLikeCommand */
        $command = new CreateVideoLikeCommand(
            (new Uuid(UuidFactory::uuid())),
            (string) $request->request->get('video_like_id'),
            (string) $request->request->get('video_id'),
            (string) $request->request->get('user_id')
        );
        
        $this->dispatch($command);

        return new ApiHttpCreatedResponse();
    }
}