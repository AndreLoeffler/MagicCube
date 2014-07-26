<?php

namespace Binaerpiloten\MagicBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Binaerpiloten\MagicBundle\Entity\Stichwort;
use Binaerpiloten\MagicBundle\Form\StichwortType;

/**
 * Stichwort controller.
 *
 * @Route("/stichwort")
 */
class StichwortController extends Controller
{

    /**
     * Lists all Stichwort entities.
     *
     * @Route("/", name="stichwort")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BinaerpilotenMagicBundle:Stichwort')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Stichwort entity.
     *
     * @Route("/", name="stichwort_create")
     * @Method("POST")
     * @Template("BinaerpilotenMagicBundle:Stichwort:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Stichwort();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('stichwort_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
    * Creates a form to create a Stichwort entity.
    *
    * @param Stichwort $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Stichwort $entity)
    {
        $form = $this->createForm(new StichwortType(), $entity, array(
            'action' => $this->generateUrl('stichwort_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Stichwort entity.
     *
     * @Route("/new", name="stichwort_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Stichwort();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Stichwort entity.
     *
     * @Route("/{id}", name="stichwort_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BinaerpilotenMagicBundle:Stichwort')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Stichwort entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Stichwort entity.
     *
     * @Route("/{id}/edit", name="stichwort_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BinaerpilotenMagicBundle:Stichwort')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Stichwort entity.');
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
    * Creates a form to edit a Stichwort entity.
    *
    * @param Stichwort $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Stichwort $entity)
    {
        $form = $this->createForm(new StichwortType(), $entity, array(
            'action' => $this->generateUrl('stichwort_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Stichwort entity.
     *
     * @Route("/{id}", name="stichwort_update")
     * @Method("PUT")
     * @Template("BinaerpilotenMagicBundle:Stichwort:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BinaerpilotenMagicBundle:Stichwort')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Stichwort entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('stichwort_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Stichwort entity.
     *
     * @Route("/{id}", name="stichwort_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('BinaerpilotenMagicBundle:Stichwort')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Stichwort entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('stichwort'));
    }

    /**
     * Creates a form to delete a Stichwort entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('stichwort_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
