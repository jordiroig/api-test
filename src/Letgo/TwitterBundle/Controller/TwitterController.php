<?php

namespace Letgo\TwitterBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\Get;
use Symfony\Component\HttpFoundation\JsonResponse;

class TwitterController extends FOSRestController
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        return $this->render('LetgoTwitterBundle:Default:index.html.twig');
    }
    
    /**
	 * @Get("/tweets/{username}", name="get_tweets")
     * @return JsonResponse
	 */   
    public function getTweetsAction($username)
    {
	    $redis = $this->get('snc_redis.default');
	    
	    if($redis->get($username)) {
		    $tweets = json_decode($redis->get($username));
	    }
	    else {
		    $tweets = $this->get('letgo.twitter.reader')->getTweetsByUser($username);
			$redis->set($username, json_encode($tweets), 'NX', 'EX', 3600);
	    }
	    
        return new JsonResponse($tweets);
    }
}
