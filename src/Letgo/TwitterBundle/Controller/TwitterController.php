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
    public function getTweetsAction($name)
    {
	    $prova = $this->get('letgo.twitter.reader')->getTweets($name);
	    die(var_dump($prova));
	    return $name;
    }
}
