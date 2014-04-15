<?php

namespace Alzheimer\PortadaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PagesController extends Controller
{
    public function quienesAction()
    {
        return $this->render('PortadaBundle:Pages:quienes_somos.html.twig');
    }
}