<?php

namespace Letgo\TwitterBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\Get;

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
	 * @Get("/tweets/{name}", name="get_tweets")
	 */   
    public function getTweetsAction($username)
    {
	    $prova = $this->get('letgo.twitter.reader')->get('statuses/user_timeline.json?screen_name='.$username.'&count=5')->send()->json();
	    die(var_dump($prova));
	    return $name;
    }
}
