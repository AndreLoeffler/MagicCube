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
    
    /**
     * Promotes User entity by name.
     *
     * @Route("/promote/{name}", name="user_promote")
     * @Method("GET")
     * @Template("FOSUserBundle:Profile:show.html.twig")
     */
    public function promoteAction($name)
    {
    	// Get our userManager, you must implement `ContainerAwareInterface`
        $userManager = $this->container->get('fos_user.user_manager');

        // Create our user and set details
        $user = $userManager->findUserByUsername($name);
        $roles = $user->getRoles();
        // superadmin?
        if (in_array('ROLE_ADMIN', $roles, true)) {
	        $user->addRole('ROLE_SUPERADMIN');
        }
        // superadmin?
        else if (in_array('ROLE_USER', $roles, true)) {
        	$user->addRole('ROLE_ADMIN');
        }

        // Update the user
        $userManager->updateUser($user, true);
    
    	return $this->redirect($this->generateUrl('user_show', array('id' => $user->getId())));
    }
    
    /**
     * Demotes User entity by name.
     *
     * @Route("/demote/{name}", name="user_demote")
     * @Method("GET")
     * @Template("FOSUserBundle:Profile:show.html.twig")
     */
    public function demoteAction($name)
    {
    	// Get our userManager, you must implement `ContainerAwareInterface`
    	$userManager = $this->container->get('fos_user.user_manager');
    
    	// Create our user and set details
    	$user = $userManager->findUserByUsername($name);
    	$roles = $user->getRoles();
    	// superadmin?
    	if (in_array('ROLE_SUPERADMIN', $roles, true)) {
    		if ($user == $this->getUser()) {
    			$user->removeRole('ROLE_SUPERADMIN');
    		}
    	}
    	// superadmin?
    	else if (in_array('ROLE_ADMIN', $roles, true)) {
    		$user->removeRole('ROLE_ADMIN');
    	}
    
    	// Update the user
    	$userManager->updateUser($user, true);
    
    	return $this->redirect($this->generateUrl('user_show', array('id' => $user->getId())));
    }
}
