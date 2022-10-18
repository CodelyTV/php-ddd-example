<?php

namespace CodelyTv\Mooc\Notifications\Infrastructure;

use Abraham\TwitterOAuth\TwitterOAuth;
use Abraham\TwitterOAuth\TwitterOAuthException;
use CodelyTv\Mooc\Notifications\Domain\SocialMediaPost;
use CodelyTv\Mooc\Notifications\Domain\SocialMediaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\DependencyInjection\FrameworkExtension;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

class TwitterRepository extends AbstractController implements SocialMediaRepository
{
    private TwitterOAuth $twitterOauthConnection;

    /**
     * @throws TwitterOAuthException
     */
    public function __construct() {

        $this->twitterOauthConnection = new TwitterOAuth(
            '1zRrpOlHQtX8hfffC927VJe2212fAAnC',
            'zTYliSpcBffffTnktDxlWt5kcaA6k8Ov8McN16U2oNxc8CdKcG41231IkuU0N',
            '27z80514284-cpO3a2R9Ta8ZkfffplFEYik8w7i2jTJw123bnVipjkf6Z',
            'azc91fffA1yYXA4fru9jT6RgoI4gTg0O312y6iD17Lf4IfzwH03C',
        );

        $this->twitterOauthConnection->setApiVersion('2');

        $content = $this->twitterOauthConnection->get("account/verify_credentials");
    }

    public function newPost(SocialMediaPost $socialMediaPost): array|object
    {
        return $this->twitterOauthConnection->post("statuses/update", ["status" => $socialMediaPost->getText()]);
    }
}