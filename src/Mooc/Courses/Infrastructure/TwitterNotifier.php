<?php
declare(strict_types=1);


namespace CodelyTv\Mooc\Courses\Infrastructure;

final class TwitterNotifier implements Notifier
{
    private string $accessToken;
    private string $accessTokenSecret;
    private string $consumerKey;
    private string $consumerKeySecret;

    public function __construct(
        string $accessToken,
        string $accessTokenSecret,
        string $consumerKey,
        string $consumerKeySecret
    ) {
        $this->accessToken       = $accessToken;
        $this->accessTokenSecret = $accessTokenSecret;
        $this->consumerKey       = $consumerKey;
        $this->consumerKeySecret = $consumerKeySecret;
    }


    public function publish(Notification $notification): void
    {
        // twitter api endpoint
        $settings = [
            'oauth_access_token'        => $this->accessToken,
            'oauth_access_token_secret' => $this->accessTokenSecret,
            'consumer_key'              => $this->consumerKey,
            'consumer_secret'           => $this->consumerKeySecret
        ];

        // twitter api endpoint
        $url = 'https://api.twitter.com/1.1/statuses/update.json';

        // twitter api endpoint request type
        $requestMethod = 'POST';

        // twitter api endpoint data
        $apiData = [
            'status' => 'Tweeting from Symfony5 with Twitter API! #CodelyTV',
        ];

        // create new twitter for api communication
        $twitter = new \TwitterAPIExchange($settings);

        // make our api call to twiiter
        $twitter->buildOauth($url, $requestMethod);
        $twitter->setPostfields($apiData);
        $response = $twitter->performRequest(true, [CURLOPT_SSL_VERIFYHOST => 0, CURLOPT_SSL_VERIFYPEER => 0]);

        // display response from twitter
//        echo '<pre>';
//        print_r(json_decode($response, true));
    }
}
