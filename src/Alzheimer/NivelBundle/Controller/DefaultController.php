<?php

namespace Alzheimer\NivelBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('NivelBundle:Default:index.html.twig');
    }
}
