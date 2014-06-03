<?php

namespace Alzheimer\NoticiasBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('NoticiasBundle:Default:index.html.twig', array('name' => $name));
    }
}
