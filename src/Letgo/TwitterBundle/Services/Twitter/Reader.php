<?php

namespace Letgo\TwitterBundle\Services\Twitter;

use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Subscriber\Oauth\Oauth1;

class Reader
{
	public function getTweets($username)
	{
		$stack = HandlerStack::create();
		$oauth = new Oauth1([
			'consumer_key'    => 'my_key',
			'consumer_secret' => 'my_secret',
			'token'           => 'my_token',
			'token_secret'    => 'my_token_secret'
		]);
		$stack->push($oauth);
		$client = new Client([
			'base_uri' => 'https://api.twitter.com/1.1',
			'handler' => $stack,
			'defaults' => ['auth' => 'oauth']
		]);

		$res = $client->get('statuses/home_timeline.json?screen_name='.$username.'&count=5');
		return $res;
	}
}