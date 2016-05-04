<?php

namespace Letgo\TwitterBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Prefix;

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
	    die($prova);
	    return $name;
    }
}
