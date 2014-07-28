<?php

namespace Binaerpiloten\MagicBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Binaerpiloten\MagicBundle\Entity\Karte;
use Binaerpiloten\MagicBundle\Form\KarteType;

/**
 * Karte controller.
 *
 * @Route("/karte")
 */
class KarteController extends Controller
{

    /**
     * Lists all Karte entities.
     *
     * @Route("/", name="karte")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BinaerpilotenMagicBundle:Karte')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Karte entity.
     *
     * @Route("/", name="karte_create")
     * @Method("POST")
     * @Template("BinaerpilotenMagicBundle:Karte:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Karte();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('karte_new'));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
    * Creates a form to create a Karte entity.
    *
    * @param Karte $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Karte $entity)
    {
        $form = $this->createForm(new KarteType(), $entity, array(
            'action' => $this->generateUrl('karte_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Karte entity.
     *
     * @Route("/new", name="karte_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Karte();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Karte entity.
     *
     * @Route("/{id}", name="karte_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BinaerpilotenMagicBundle:Karte')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Karte entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Karte entity.
     *
     * @Route("/{id}/edit", name="karte_edit")
     * @Method("GET")
     * @Template("BinaerpilotenMagicBundle:Karte:edit.html.twig")
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BinaerpilotenMagicBundle:Karte')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Karte entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Karte entity.
    *
    * @param Karte $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Karte $entity)
    {
        $form = $this->createForm(new KarteType(), $entity, array(
            'action' => $this->generateUrl('karte_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Karte entity.
     *
     * @Route("/{id}", name="karte_update")
     * @Method("PUT")
     * @Template("BinaerpilotenMagicBundle:Karte:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BinaerpilotenMagicBundle:Karte')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Karte entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('karte'));
        }

        return array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Karte entity.
     *
     * @Route("/{id}", name="karte_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('BinaerpilotenMagicBundle:Karte')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Karte entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('karte'));
    }

    /**
     * Creates a form to delete a Karte entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('karte_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
