<?php

namespace Binaerpiloten\MagicBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Binaerpiloten\MagicBundle\Entity\Farbe;
use Binaerpiloten\MagicBundle\Form\FarbeType;

/**
 * Farbe controller.
 *
 * @Route("/farbe")
 */
class FarbeController extends Controller
{

    /**
     * Lists all Farbe entities.
     *
     * @Route("/", name="farbe")
     * @Method("GET")
     * @Template("BinaerpilotenMagicBundle:Karte/Farbe:index.html.twig")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BinaerpilotenMagicBundle:Farbe')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Farbe entity.
     *
     * @Route("/", name="farbe_create")
     * @Method("POST")
     * @Template("BinaerpilotenMagicBundle:Karte/Farbe:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Farbe();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('farbe'));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
    * Creates a form to create a Farbe entity.
    *
    * @param Farbe $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Farbe $entity)
    {
        $form = $this->createForm(new FarbeType(), $entity, array(
            'action' => $this->generateUrl('farbe_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Farbe entity.
     *
     * @Route("/new", name="farbe_new")
     * @Method("GET")
     * @Template("BinaerpilotenMagicBundle:Karte/Farbe:new.html.twig")
     */
    public function newAction()
    {
        $entity = new Farbe();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Farbe entity.
     *
     * @Route("/{id}", name="farbe_show")
     * @Method("GET")
     * @Template("BinaerpilotenMagicBundle:Karte/Farbe:show.html.twig")
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BinaerpilotenMagicBundle:Farbe')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Farbe entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Farbe entity.
     *
     * @Route("/{id}/edit", name="farbe_edit")
     * @Method("GET")
     * @Template("BinaerpilotenMagicBundle:Karte/Farbe:edit.html.twig")
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BinaerpilotenMagicBundle:Farbe')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Farbe entity.');
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
    * Creates a form to edit a Farbe entity.
    *
    * @param Farbe $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Farbe $entity)
    {
        $form = $this->createForm(new FarbeType(), $entity, array(
            'action' => $this->generateUrl('farbe_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Farbe entity.
     *
     * @Route("/{id}", name="farbe_update")
     * @Method("PUT")
     * @Template("BinaerpilotenMagicBundle:Farbe:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BinaerpilotenMagicBundle:Farbe')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Farbe entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('farbe'));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Farbe entity.
     *
     * @Route("/{id}", name="farbe_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('BinaerpilotenMagicBundle:Farbe')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Farbe entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('farbe'));
    }

    /**
     * Creates a form to delete a Farbe entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('farbe_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
