<?php

namespace Alzheimer\NoticiasBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Alzheimer\NoticiasBundle\Entity\Noticias;
use Alzheimer\NoticiasBundle\Form\NoticiasType;

/**
 * NoticiasPublicas controller.
 *
 * @Route("/noticias_publicas")
 */
class NoticiasPublicasController extends Controller
{

    /**
     * Lists all Noticias entities.
     *
     * @Route("/", name="noticias")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('NoticiasBundle:Noticias')->findBy(array(),array('fecha'=>'DESC'));
        
        return $this->render('NoticiasBundle:Noticias:noticias_publico.html.twig', array('entities' => $entities));
        
     }
    

}
