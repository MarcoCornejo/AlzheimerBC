<?php

namespace Alzheimer\PortadaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class IndexController extends Controller
{
    public function indexAction()
    {
    	$em = $this->getDoctrine()->getManager();
    	 $banner=$em->getRepository('EventosBundle:Eventos')->ImagenBanner();

        return $this->render('PortadaBundle:Index:index.html.twig', array('banner'=>$banner));

    }
}