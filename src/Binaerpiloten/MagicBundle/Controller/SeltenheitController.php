<?php

namespace Binaerpiloten\MagicBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Binaerpiloten\MagicBundle\Entity\Seltenheit;
use Binaerpiloten\MagicBundle\Form\SeltenheitType;

/**
 * Seltenheit controller.
 *
 * @Route("/seltenheit")
 */
class SeltenheitController extends Controller
{

    /**
     * Lists all Seltenheit entities.
     *
     * @Route("/", name="seltenheit")
     * @Method("GET")
     * @Template("BinaerpilotenMagicBundle:Karte/Seltenheit:index.html.twig")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BinaerpilotenMagicBundle:Seltenheit')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Seltenheit entity.
     *
     * @Route("/", name="seltenheit_create")
     * @Method("POST")
     * @Template("BinaerpilotenMagicBundle:Karte/Seltenheit:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Seltenheit();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('seltenheit'));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
    * Creates a form to create a Seltenheit entity.
    *
    * @param Seltenheit $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Seltenheit $entity)
    {
        $form = $this->createForm(new SeltenheitType(), $entity, array(
            'action' => $this->generateUrl('seltenheit_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Seltenheit entity.
     *
     * @Route("/new", name="seltenheit_new")
     * @Method("GET")
     * @Template("BinaerpilotenMagicBundle:Karte/Seltenheit:new.html.twig")
     */
    public function newAction()
    {
        $entity = new Seltenheit();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Seltenheit entity.
     *
     * @Route("/{id}", name="seltenheit_show")
     * @Method("GET")
     * @Template("BinaerpilotenMagicBundle:Karte/Seltenheit:show.html.twig")
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BinaerpilotenMagicBundle:Seltenheit')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Seltenheit entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Seltenheit entity.
     *
     * @Route("/edit/{id}", name="seltenheit_edit")
     * @Method("GET")
     * @Template("BinaerpilotenMagicBundle:Karte/Seltenheit:edit.html.twig")
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BinaerpilotenMagicBundle:Seltenheit')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Seltenheit entity.');
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
    * Creates a form to edit a Seltenheit entity.
    *
    * @param Seltenheit $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Seltenheit $entity)
    {
        $form = $this->createForm(new SeltenheitType(), $entity, array(
            'action' => $this->generateUrl('seltenheit_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Seltenheit entity.
     *
     * @Route("/{id}", name="seltenheit_update")
     * @Method("PUT")
     * @Template("BinaerpilotenMagicBundle:Karte/Seltenheit:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BinaerpilotenMagicBundle:Seltenheit')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Seltenheit entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('seltenheit'));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Seltenheit entity.
     *
     * @Route("/delete/{id}", name="seltenheit_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('BinaerpilotenMagicBundle:Seltenheit')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Seltenheit entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('seltenheit'));
    }

    /**
     * Creates a form to delete a Seltenheit entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('seltenheit_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
