<?php

namespace Binaerpiloten\MagicBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Binaerpiloten\MagicBundle\Entity\User;


/**
 * User controller.
 *
 * @Route("/user")
 */
class UserController extends Controller
{

    /**
     * Lists all User entities.
     *
     * @Route("/list", name="user")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BinaerpilotenMagicBundle:User')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    
    /**
     * Finds and displays a User entity.
     *
     * @Route("/{id}", name="user_show")
     * @Method("GET")
     * @Template("FOSUserBundle:Profile:show.html.twig")
     */
    public function showAction($id)
    {
    	$em = $this->getDoctrine()->getManager();
    
    	$entity = $em->getRepository('BinaerpilotenMagicBundle:User')->find($id);
    
    	if (!$entity) {
    		throw $this->createNotFoundException('Unable to find User entity.');
    	}
    
    	return array(
    			'user'      => $entity,
    	);
    }
}
