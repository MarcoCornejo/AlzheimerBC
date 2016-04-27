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
 * EventosPublicas controller.
 *
 * @Route("/eventos_publicos")
 */
class EventosPublicosController extends Controller
{

    /**
     * Lists all Eventos entities.
     *
     * @Route("/", name="eventos_publicos")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $entities=$em->getRepository('EventosBundle:Eventos')->NoticiasRecientes();

        $pasadas=$em->getRepository('EventosBundle:Eventos')->NoticiasPasadas();

        return $this->render('EventosBundle:Eventos:eventos_publicos.html.twig',
            array('entities'=>$entities, 'pasadas'=>$pasadas));      

     }    

}
