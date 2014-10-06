<?php

namespace Alzheimer\UsuarioBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Alzheimer\UsuarioBundle\Entity\Usuario;
use Alzheimer\UsuarioBundle\Form\UsuarioType;

/**
 * Usuario controller.
 *
 * @Route("/usuario")
 */
class UsuarioController extends Controller
{

    /**
     * Lists all Usuario entities.
     *
     * @Route("/", name="usuario")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('UsuarioBundle:Usuario')->findAll();


        return array(
            'entities' => $entities,
        );
    }

    /**
     * Creates a new Usuario entity.
     *
     * @Route("/", name="usuario_new")
     * @Method("POST")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Usuario();
        $form = $this->createForm(new UsuarioType(), $entity);

        $form->handleRequest($this->getRequest());

        if ($form->isValid()) {

            $entity->setSalt(md5(time()));

            $encoder = $this->get('security.encoder_factory')->getEncoder($entity);
            $passwordCodificado = $encoder->encodePassword(
                $entity->getPassword(),
                $entity->getSalt()
            );
            $entity->setPassword($passwordCodificado);

            $entity->subirFoto($this->container->getParameter('usuarios.imagenes'));

            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('usuario_show', array('id' => $entity->getId())));
        }

        return array('entity' => $entity, 'form' => $form->createView());
    }

    /**
     * Finds and displays a Usuario entity.
     *
     * @Route("/{id}", name="usuario_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UsuarioBundle:Usuario')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Usuario entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Usuario entity.
     *
     * @Route("/{id}/edit", name="usuario_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UsuarioBundle:Usuario')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Noticias entity.');
        }


        $form = $this->createForm(new UsuarioType(), $entity, array(
            'action' => $this->generateUrl('usuario_edit', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->handleRequest($this->getRequest());

       if ($form->isValid()) {

            $entity->setSalt(md5(time()));

            $encoder = $this->get('security.encoder_factory')->getEncoder($entity);
            $passwordCodificado = $encoder->encodePassword(
                $entity->getPassword(),
                $entity->getSalt()
            );
            $entity->setPassword($passwordCodificado);
            $entity->subirFoto($this->container->getParameter('usuarios.imagenes'));
            $em->flush();

            return $this->redirect($this->generateUrl('usuario_index'));
        }
      
        return array('entity' => $entity, 'form' => $form->createView());     
    }

    /**
    * Creates a form to edit a Usuario entity.
    *
    * @param Usuario $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Usuario $entity)
    {
        $form = $this->createForm(new UsuarioType(), $entity, array(
            'action' => $this->generateUrl('usuario_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Actualizar'));

        return $form;
    }
    /**
     * Edits an existing Usuario entity.
     *
     * @Route("/{id}", name="usuario_update")
     * @Method("PUT")
     * @Template("UsuarioBundle:Usuario:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UsuarioBundle:Usuario')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Usuario entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('usuario_show', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Usuario entity.
     *
     * @Route("/{id}", name="usuario_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('UsuarioBundle:Usuario')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Usuario entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('usuario_index'));
    }

    /**
     * Creates a form to delete a Usuario entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('usuario_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Eliminar'))
            ->getForm()
        ;
    }

    public function menuAction(){

        return $this->render('UsuarioBundle:Usuario:MenuUsuario.html.twig');

    }


    
}
