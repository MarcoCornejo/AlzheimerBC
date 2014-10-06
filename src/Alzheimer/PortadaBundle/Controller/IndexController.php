<?php

namespace Alzheimer\PortadaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class IndexController extends Controller
{
    public function indexAction()
    {

    	$em = $this->getDoctrine()->getManager();
    	if( $this->container->get('security.context')->isGranted('IS_AUTHENTICATED_FULLY') )

    	 $banner=$em->getRepository('EventosBundle:Eventos')->ImagenBanner();
    	 $imagen=$em->getRepository('ImagenBundle:Imagen')->Imagen();



        return $this->render('PortadaBundle:Index:index.html.twig', 
        	array('banner'=>$banner,'imagen'=>$imagen));

    }
}