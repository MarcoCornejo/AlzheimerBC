<?php

namespace Alzheimer\GrupoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('GrupoBundle:Default:index.html.twig', array('name' => $name));
    }
}
