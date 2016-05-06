<?php

namespace Letgo\TwitterBundle\Tests\Services\Twitter;

use Letgo\TwitterBundle\Services\Twitter\Reader;

class ReaderTest extends \PHPUnit_Framework_TestCase
{
    public function testGetTweetsByUser()
    {
		$response = $this->getMockBuilder('GuzzleHttp\Psr7\Response')->disableOriginalConstructor()->getMock();
		$response->method('getBody')->willReturn('[{"text":"prova1"}, {"text":"prova2"}, {"text":"prova3"}]');

        $twitter_client_mocked = $this->getMockBuilder('GuzzleHttp\Client')->disableOriginalConstructor()->setMethods(array('get'))->getMock();
		$twitter_client_mocked->method('get')->willReturn($response);
        
        $username = 'jordiletgo';

        $reader = new Reader($twitter_client_mocked);
        $result = $reader->getTweetsByUser($username);

		$expected = array("prova1", "prova2", "prova3");
        $this->assertEquals($expected, $result);
    }
    
    public function testGetTweetsByUserWithNoTweets()
    {
	    $response = $this->getMockBuilder('GuzzleHttp\Psr7\Response')->disableOriginalConstructor()->getMock();
		$response->method('getBody')->willReturn('[]');

        $twitter_client_mocked = $this->getMockBuilder('GuzzleHttp\Client')->disableOriginalConstructor()->setMethods(array('get'))->getMock();
		$twitter_client_mocked->method('get')->willReturn($response);

        $username = 'jordiletgo';

        $reader = new Reader($twitter_client_mocked);
        $result = $reader->getTweetsByUser($username);
        
        $expected = array();
        $this->assertEquals($expected, $result);
    }
}