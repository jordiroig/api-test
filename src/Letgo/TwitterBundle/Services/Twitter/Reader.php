<?php

namespace Letgo\TwitterBundle\Services\Twitter;

use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Subscriber\Oauth\Oauth1;

class Reader
{
	private $oauth1;
	private $base_url;

	public function __construct(
		Oauth1 $oauth1,
		$base_url
	) {
		$this->oauth1 = $oauth1;
		$this->base_url = $base_url;
	}

	public function getTweets($username)
	{
		$stack = HandlerStack::create();
		$stack->push($this->oauth1);
		$client = new Client([
			'base_uri' => $this->base_url,
			'handler' => $stack,
			'auth' => 'oauth'
		]);

		$res = $client->get('statuses/user_timeline.json?screen_name='.$username.'&count=10&exclude_replies=true')->getBody()->getContents();
		return $res;
	}
}