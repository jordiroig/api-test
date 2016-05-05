<?php

namespace Letgo\TwitterBundle\Services\Twitter;

use Exception;
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

	/**
	 * @param $username
	 * @return array
     */
	public function getTweetsByUser($username)
	{
		$stack = HandlerStack::create();
		$stack->push($this->oauth1);
		$client = new Client([
			'base_uri' => $this->base_url,
			'handler' => $stack,
			'auth' => 'oauth'
		]);

		try {
			$res = $client->get('statuses/user_timeline.json?screen_name=' . $username . '&count=10')->getBody();
		} catch (Exception $e) {
			return array('error' => $e->getCode(), 'message' => $e->getMessage());
		};
		$res_json = json_decode($res);
		$result_array = array();
		if(count($res_json)) {
			foreach ($res_json as $tweet) {
				array_push($result_array, $tweet->text);
			}
		}

		return $result_array;
	}
}