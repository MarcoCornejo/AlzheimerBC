<?php

namespace Alzheimer\EventosBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Alzheimer\EventosBundle\Entity\Eventos;
use Alzheimer\EventosBundle\Form\EventosType;

/**
 * EventosPasados controller.
 *
 * @Route("/eventos_pasados")
 */
class EventosPasadosController extends Controller
{

    /**
     * Lists all Eventos entities.
     *
     * @Route("/", name="eventos_pasados")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();       

        $pasadas=$em->getRepository('EventosBundle:Eventos')->NoticiasPasadas();

        return $this->render('EventosBundle:Eventos:eventos_pasados.html.twig',
            array('pasadas'=>$pasadas));      

     }    

}
