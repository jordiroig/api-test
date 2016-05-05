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
			'consumer_key'    => 'Ct67CMSMLMygbIO07np38U4KV',
			'consumer_secret' => 'Ft4CS5tE0VLQ3OiHWSlaABQeADsslVRywBUghdelT4mw2hwPq4',
			'token'           => '728145508351385600-hkiOhSoBkrDBimUMhfCN6vSu6EzUJth',
			'token_secret'    => 'F2oxc0DoT9Va02Vq6fevENKZLBzk50tk9dlvaX71xOFnc'
		]);
		$stack->push($oauth);
		$client = new Client([
			'base_uri' => 'https://api.twitter.com/1.1/',
			'handler' => $stack,
			'auth' => 'oauth'
		]);

		$res = $client->get('statuses/home_timeline.json?screen_name='.$username.'&count=5');
		return $res;
	}
}