<?php

namespace Alzheimer\NivelBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Alzheimer\NivelBundle\Entity\Nivel;
use Alzheimer\NivelBundle\Form\NivelType;

/**
 * Nivel controller.
 *
 * @Route("/nivel")
 */
class NivelController extends Controller
{

    /**
     * Lists all Nivel entities.
     *
     * @Route("/", name="nivel")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('NivelBundle:Nivel')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Nivel entity.
     *
     * @Route("/", name="nivel_create")
     * @Method("POST")
     * @Template("NivelBundle:Nivel:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Nivel();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('nivel_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
    * Creates a form to create a Nivel entity.
    *
    * @param Nivel $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Nivel $entity)
    {
        $form = $this->createForm(new NivelType(), $entity, array(
            'action' => $this->generateUrl('nivel_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Nivel entity.
     *
     * @Route("/new", name="nivel_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Nivel();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Nivel entity.
     *
     * @Route("/{id}", name="nivel_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NivelBundle:Nivel')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Nivel entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Nivel entity.
     *
     * @Route("/{id}/edit", name="nivel_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NivelBundle:Nivel')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Nivel entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Nivel entity.
    *
    * @param Nivel $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Nivel $entity)
    {
        $form = $this->createForm(new NivelType(), $entity, array(
            'action' => $this->generateUrl('nivel_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Nivel entity.
     *
     * @Route("/{id}", name="nivel_update")
     * @Method("PUT")
     * @Template("NivelBundle:Nivel:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NivelBundle:Nivel')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Nivel entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('nivel_show', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Nivel entity.
     *
     * @Route("/{id}", name="nivel_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('NivelBundle:Nivel')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Nivel entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('nivel_index'));
    }

    /**
     * Creates a form to delete a Nivel entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('nivel_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
