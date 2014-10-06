<?php

namespace Alzheimer\BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('BackendBundle:Default:index.html.twig', array('name' => $name));
    }


    public function imagenesAction(){

        return $this->render('BackendBundle:Default:imagenes.html.twig');

    }  
}
