<?php

namespace Alzheimer\PortadaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PagesController extends Controller
{
    public function quienesAction()
    {
        return $this->render('PortadaBundle:Pages:quienes_somos.html.twig');
    }
    
    public function demenciaAction()
    {
        return $this->render('PortadaBundle:Pages:demencia.html.twig');
    }

    public function alzheimerAction()
    {
        return $this->render('PortadaBundle:Pages:alzheimer.html.twig');
    }
    
    public function factoresAction()
    {
        return $this->render('PortadaBundle:Pages:riesgo.html.twig');
    }
    public function acudirAction()
    {
        return $this->render('PortadaBundle:Pages:acudir.html.twig');
    }

    public function tratamientosAction()
    {
        return $this->render('PortadaBundle:Pages:tratamientos.html.twig');
    }

    public function detectandoAction()
    {
        return $this->render('PortadaBundle:Pages:senales.html.twig');
    }
 
    public function preguntasAction()
    {
        return $this->render('PortadaBundle:Pages:preguntas.html.twig');
    }

    public function diagnosticoAction()
    {
        return $this->render('PortadaBundle:Pages:diagnostico.html.twig');
    }
 
    public function edadAction()
    {
        return $this->render('PortadaBundle:Pages:edad_temprana.html.twig');
    }

    public function ninosAction()
    {
        return $this->render('PortadaBundle:Pages:ninos_jovenes.html.twig');
    }

    public function legalesAction()
    {
        return $this->render('PortadaBundle:Pages:legales.html.twig');
    }

    public function seguridadAction()
    {
        return $this->render('PortadaBundle:Pages:seguridad.html.twig');
    }

    public function vidaAction()
    {
        return $this->render('PortadaBundle:Pages:vida_diaria.html.twig');
    }

    public function etapasAction()
    {
        return $this->render('PortadaBundle:Pages:etapas_comportamiento.html.twig');
    }

    public function opcionesAction()
    {
        return $this->render('PortadaBundle:Pages:opciones_cuidados.html.twig');
    }

    public function gruposAction()
    {
        return $this->render('PortadaBundle:Pages:grupos_apoyo.html.twig');
    }

    public function contactoAction()
    {
        return $this->render('PortadaBundle:Pages:contacto.html.twig');
    }


}
