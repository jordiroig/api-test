<?php

namespace Letgo\TwitterBundle\Services\Twitter;

use Exception;
use GuzzleHttp\Client as GuzzleClient;

class Reader
{
	private $twitter_client;

	public function __construct(
		GuzzleClient $twitter_client
	) {
		$this->twitter_client = $twitter_client;
	}

	/**
	 * @param $username
	 * @return array
     */
	public function getTweetsByUser($username)
	{
		try {
			$res = $this->twitter_client->get('statuses/user_timeline.json?screen_name=' . $username . '&count=10')->getBody();
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