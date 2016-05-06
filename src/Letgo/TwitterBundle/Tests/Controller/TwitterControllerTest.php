<?php

namespace Letgo\TwitterBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TwitterControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/v1/tweets/jordiletgo');
		$this->assertEquals(200, $client->getResponse()->getStatusCode());
		$this->assertTrue($client->getResponse()->headers->contains('Content-Type', 'application/json'));
    }
}
