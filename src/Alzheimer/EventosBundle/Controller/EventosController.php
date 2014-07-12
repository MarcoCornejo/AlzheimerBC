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
 * Eventos controller.
 *
 * @Route("/eventos")
 */
class EventosController extends Controller
{

    /**
     * Lists all Eventos entities.
     *
     * @Route("/", name="eventos")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('EventosBundle:Eventos')->findAll();

        $paginador=$this->get('knp_paginator');
        $paginar=$paginador->paginate($entities, $this->getRequest()->query->get('page',1),3);

        return array('entities' => $paginar );
    }
    /**
     * Creates a new Eventos entity.
     *
     * @Route("/", name="eventos_create")
     * @Method("POST")
     * @Template("EventosBundle:Eventos:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Eventos();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('eventos_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
    * Creates a form to create a Eventos entity.
    *
    * @param Eventos $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Eventos $entity)
    {
        $form = $this->createForm(new EventosType(), $entity, array(
            'action' => $this->generateUrl('eventos_create'),
            'method' => 'POST',
        ));

        #$form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Eventos entity.
     *
     * @Route("/new", name="eventos_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Eventos();
        $form   = $this->createForm(new EventosType(), $entity);

        $form->handleRequest($this->getRequest());

        if ($form->isValid()) {
            $entity->subirFoto($this->container->getParameter('eventos.imagenes'));
            $entity->subirFoto2($this->container->getParameter('eventos.imagenes'));
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('eventos_show', array('id' => $entity->getId())));
        }

        return array('entity' => $entity, 'form' => $form->createView());  

    }

    /**
     * Finds and displays a Eventos entity.
     *
     * @Route("/{id}", name="eventos_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EventosBundle:Eventos')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Eventos entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Eventos entity.
     *
     * @Route("/{id}/edit", name="eventos_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EventosBundle:Eventos')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Eventos entity.');
        }

        $form = $this->createForm(new EventosType(), $entity, array(
            'action' => $this->generateUrl('eventos_edit', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->handleRequest($this->getRequest());

       if ($form->isValid()) {
            $entity->subirFoto($this->container->getParameter('eventos.imagenes'));
            $em->flush();

            return $this->redirect($this->generateUrl('eventos_index'));
        }
       
        return array('entity' => $entity, 'form' => $form->createView());   
        
    }

    /**
    * Creates a form to edit a Eventos entity.
    *
    * @param Eventos $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Eventos $entity)
    {
        $form = $this->createForm(new EventosType(), $entity, array(
            'action' => $this->generateUrl('eventos_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        #$form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Eventos entity.
     *
     * @Route("/{id}", name="eventos_update")
     * @Method("PUT")
     * @Template("EventosBundle:Eventos:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EventosBundle:Eventos')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Eventos entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('eventos_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Eventos entity.
     *
     * @Route("/{id}", name="eventos_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('EventosBundle:Eventos')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Eventos entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('eventos_index'));
    }

    /**
     * Creates a form to delete a Eventos entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('eventos_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Eliminar'))
            ->getForm()
        ;
    }
}
