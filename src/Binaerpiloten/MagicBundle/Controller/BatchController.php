<?php

namespace Binaerpiloten\MagicBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Binaerpiloten\MagicBundle\Entity\Batch;
use Binaerpiloten\MagicBundle\Form\BatchType;
use Binaerpiloten\MagicBundle\Entity\BatchItem;

/**
 * Batch controller.
 *
 * @Route("/batch")
 */
class BatchController extends Controller
{
    /**
     * Creates a new Batch entity.
     *
     * @Route("/", name="batch_create")
     * @Method("POST")
     * @Template("BinaerpilotenMagicBundle:Batch:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Batch();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
        	$names = explode("|",$entity->getNames());
        	
            $em = $this->getDoctrine()->getManager();
            foreach ($names as $n) {
            	$b = new BatchItem($n);
	            $em->persist($b);
            }
            $em->flush();

            return $this->redirect($this->generateUrl('batchitem'));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Batch entity.
     *
     * @param Batch $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Batch $entity)
    {
        $form = $this->createForm(new BatchType(), $entity, array(
            'action' => $this->generateUrl('batch_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Batch entity.
     *
     * @Route("/new", name="batch_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Batch();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }
}
