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
     * @Route("/", name="user")
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
     * Lists all User entities.
     *
     * @Route("/friends", name="user_friends")
     * @Method("GET")
     * @Template("BinaerpilotenMagicBundle:User:index.html.twig")
     */
    public function indexFriendAction()
    {
    	$em = $this->getDoctrine()->getManager();
    	$user = $this->getUser();
    	
    	$entities = $em->createQuery("SELECT u FROM Binaerpiloten\MagicBundle\Entity\User u");
    
   		return array(
   				'entities' => $entities,
   		);
    }

    /**
     * Finds and displays a User entity.
     *
     * @Route("/{id}", name="user_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BinaerpilotenMagicBundle:User')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find User entity.');
        }

        return array(
            'entity'      => $entity,
        );
    }
}
