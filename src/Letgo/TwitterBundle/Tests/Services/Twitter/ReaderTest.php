<?php

namespace Letgo\TwitterBundle\Tests\Services\Twitter;

use Letgo\TwitterBundle\Services\Twitter\Reader;
use SocialCar\CoreBundle\Tests\Abstracts\AbstractTest;

class ReaderTest extends AbstractTest
{
    public function testgetTweetsByUser()
    {
        $twitter_client = $this->mockObject('GuzzleHttp\Client', [
            ['method' => 'getBody', 'times' => 1, 'return' => '']
        ]);
        $username = 'jordiletgo';

        $reader = new Reader($twitter_client);
        $result = $reader->getTweetsByUser($username);
    }
}