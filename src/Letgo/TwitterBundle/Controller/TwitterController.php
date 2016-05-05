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
	    $tweets = $this->get('letgo.twitter.reader')->getTweetsByUser($username);
        return new JsonResponse($tweets);
    }
}
