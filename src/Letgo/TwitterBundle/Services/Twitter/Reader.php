<?php

namespace Letgo\TwitterBundle\Services\Twitter;

use GuzzleHttp\Client as GuzzleHttpClient;

class Reader
{
	private $twitter_client;

	public function __construct(
		GuzzleHttpClient $twitter_client
	) {
		$this->twitter_client = $twitter_client;
	}

	public function getTweets($username)
	{
		$res = $this->twitter_client->get('statuses/home_timeline.json?screen_name='.$username.'&count=5');

		return $res;
	}
}