<?php

namespace Alzheimer\PortadaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class IndexController extends Controller
{
    public function indexAction()
    {
        return $this->render('PortadaBundle:Index:index.html.twig');
    }
}