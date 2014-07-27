<?php

namespace Binaerpiloten\MagicBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Binaerpiloten\MagicBundle\Entity\KarteFilter;
use Binaerpiloten\MagicBundle\Form\KarteFilterType;

/**
 * KarteFilter controller.
 *
 * @Route("/kartefilter")
 */
class KarteFilterController extends Controller
{

    /**
     * Creates a new KarteFilter entity.
     *
     * @Route("/", name="kartefilter_create")
     * @Method("POST")
     * @Template("BinaerpilotenMagicBundle:KarteFilter:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new KarteFilter();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            return $this->displayResults($entity);
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
    * Creates a form to create a KarteFilter entity.
    *
    * @param KarteFilter $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(KarteFilter $entity)
    {
        $form = $this->createForm(new KarteFilterType(), $entity, array(
            'action' => $this->generateUrl('kartefilter_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new KarteFilter entity.
     *
     * @Route("/new", name="kartefilter_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new KarteFilter();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }
    
    /**
     * Displays list of matches filtered by Filter-object.
     */
    private function displayResults(KarteFilter $filter) {
    	$em = $this->getDoctrine()->getManager();
    	
    	$repository = $this->getDoctrine()->getRepository('BinaerpilotenMagicBundle:Karte');
    	$query = $repository->createQueryBuilder('s');
    	$parameters = array();
    	
        if ($filter->getTyp() != null) {
    		$types = $filter->getTyp()->toArray();
    		//$query->andWhere($query->expr()->in('ct', $types));
    		$i = 0;
    		$memstring = "";
   			foreach ($types as $t) {
				$memstring .= ":type".$i." MEMBER OF s.typ";   
				$parameters[':type'.$i] = $types[$i];
				$i++;
				if (sizeof($types) > $i) $memstring .= " AND ";
   			}
   			$query->andWhere($memstring);
    		
    	}
    	
    	echo $query;
    	
    	$query->setParameters($parameters);
    	$entities = $query->getQuery()->getResult();
    	
    	return $this->render('BinaerpilotenMagicBundle:Karte:index.html.twig',
    			array('entities' => $entities)
    	);
    }
}
