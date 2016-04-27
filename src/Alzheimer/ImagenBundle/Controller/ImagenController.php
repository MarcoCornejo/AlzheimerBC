<?php

namespace Alzheimer\ImagenBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Alzheimer\ImagenBundle\Entity\Imagen;
use Alzheimer\ImagenBundle\Form\ImagenType;

/**
 * Imagen controller.
 *
 * @Route("/imagen")
 */
class ImagenController extends Controller
{

    /**
     * Lists all Imagen entities.
     *
     * @Route("/", name="imagen")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ImagenBundle:Imagen')->findAll();

        $paginador=$this->get('knp_paginator');
        $paginar=$paginador->paginate($entities, $this->getRequest()->query->get('page',1),3);

        return array('entities' => $paginar );


        
    }
    /**
     * Creates a new Imagen entity.
     *
     * @Route("/", name="imagen_create")
     * @Method("POST")
     * @Template("ImagenBundle:Imagen:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Imagen();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('imagen_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    

    /**
     * Displays a form to create a new Imagen entity.
     *
     * @Route("/new", name="imagen_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Imagen();
        $form   = $this->createForm(new ImagenType,$entity);

        $form->handleRequest($this->getRequest());

        if ($form->isValid()) {
            $entity->subirFoto($this->container->getParameter('imagen.imagenes'));            
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('imagen_show', array('id' => $entity->getId())));
        }

        return array('entity' => $entity,'form'   => $form->createView(),);
    }

    /**
     * Finds and displays a Imagen entity.
     *
     * @Route("/{id}", name="imagen_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ImagenBundle:Imagen')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Imagen entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Imagen entity.
     *
     * @Route("/{id}/edit", name="imagen_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ImagenBundle:Imagen')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Imagen entity.');
        }

       $form = $this->createForm(new ImagenType(), $entity, array(
            'action' => $this->generateUrl('imagen_edit', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->handleRequest($this->getRequest());

       if ($form->isValid()) {
            $entity->subirFoto($this->container->getParameter('imagen.imagenes'));
            $em->flush();

            return $this->redirect($this->generateUrl('imagen_index'));
        }
        return array('entity' => $entity, 'form'=> $form->createView());
    }

    /**
    * Creates a form to edit a Imagen entity.
    *
    * @param Imagen $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Imagen $entity)
    {
        $form = $this->createForm(new ImagenType(), $entity, array(
            'action' => $this->generateUrl('imagen_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        #$form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Imagen entity.
     *
     * @Route("/{id}", name="imagen_update")
     * @Method("PUT")
     * @Template("ImagenBundle:Imagen:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ImagenBundle:Imagen')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Imagen entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('imagen_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Imagen entity.
     *
     * @Route("/{id}", name="imagen_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ImagenBundle:Imagen')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Imagen entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('imagen_index'));
    }

    /**
     * Creates a form to delete a Imagen entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('imagen_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Eliminar'))
            ->getForm()
        ;
    }
}
