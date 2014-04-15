<?php

namespace Alzheimer\PortadaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class LogController extends Controller
{
    public function indexAction()
    {
        return $this->render('PortadaBundle:LogIn:index.html.twig');
    }
}
