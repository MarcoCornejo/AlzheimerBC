<?php

namespace Alzheimer\ImagenBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('ImagenBundle:Default:index.html.twig', array('name' => $name));
    }
}
