<?php

namespace Binaerpiloten\MagicBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Binaerpiloten\MagicBundle\Entity\BatchItem;
use Binaerpiloten\MagicBundle\Form\BatchItemType;
use Binaerpiloten\MagicBundle\Entity\Karte;
use Binaerpiloten\MagicBundle\Form\KarteType;

/**
 * BatchItem controller.
 *
 * @Route("/batchitem")
 */
class BatchItemController extends Controller
{

    /**
     * Lists all BatchItem entities.
     *
     * @Route("/", name="batchitem",options={"expose"=true})
     * @Method("GET")
     * @Template("BinaerpilotenMagicBundle:Batch/BatchItem:index.html.twig")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BinaerpilotenMagicBundle:BatchItem')->findAll();
        
        $deleteForms = array();
        
        foreach ($entities as $entity) {
        	$deleteForms[$entity->getId()] = $this->createDeleteForm($entity->getId())->createView();
        }

        return array(
            'entities' => $entities,
        	'deleteForms' => $deleteForms,
        );
    }
    /**
     * Finds and displays a BatchItem entity.
     *
     * @Route("/{id}", name="batchitem_show")
     * @Method("GET")
     * @Template("BinaerpilotenMagicBundle:Batch/BatchItem:show.html.twig")
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BinaerpilotenMagicBundle:BatchItem')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find BatchItem entity.');
        }

        $work = $entity->getWorking();
        $user = $this->get('security.context')->getToken()->getUser();
        
        if ($work == null) $entity->setWorking($user);
        
        if (!$this->get('security.context')->isGranted('ROLE_SUPERADMIN') 
        	&& $entity->getWorking() !== $user) {
        	throw $this->createNotFoundException('Lock active for user '.$work->getName().'.');
        }
        
        $em->persist($entity);
        $em->flush();
        return $this->redirect($this->generateUrl('karte_new_batch', array('id' => $entity->getId())));
    }

    /**
     * Deletes a BatchItem entity.
     *
     * @Route("/{id}", name="batchitem_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('BinaerpilotenMagicBundle:BatchItem')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find BatchItem entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('batchitem'));
    }

    /**
     * Creates a form to delete a BatchItem entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('batchitem_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
    /**
     * Frees locked batch event by timeout. See tplscript-block in Karte->new.html.twig.
     * SuperAdmin version for Button use. 
     *
     * @Route("/free/{id}/admin", name="batchitem_free_superadmin")
     * @Method("GET")
     */
    public function freeSuperAdminAction($id) {
    	$this->freeLock($id);
    	
    	return $this->redirect($this->generateUrl('batchitem'));
    }
    
    /**
     * Frees locked batch event by timeout. See tplscript-block in Karte->new.html.twig.
     *
     * @Route("/free/{id}", name="batchitem_free",options={"expose"=true})
     * @Method("GET")
     */
    public function freeAction($id) {
    	$this->freeLock($id);
    	 
    	// this is just plain stupid... yes, of course, jquery has to handle the redirect,
    	// so just give it some clumsy string
    	return new Response($this->generateUrl('batchitem'));
    }
    
    private function freeLock($id) {
    	$em = $this->getDoctrine()->getManager();
    	 
    	$entity = $em->getRepository('BinaerpilotenMagicBundle:BatchItem')->find($id);
    	 
    	$entity->setWorking(null);
    	 
    	$em->persist($entity);
    	$em->flush();
    }
}
