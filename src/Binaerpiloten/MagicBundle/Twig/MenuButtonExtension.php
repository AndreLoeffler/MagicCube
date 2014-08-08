<?php

namespace Binaerpiloten\MagicBundle\Twig;

use Symfony\Component\Routing\Router;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class MenuButtonExtension extends \Twig_Extension {
	
	private $router;

    public function __construct(UrlGeneratorInterface $router) {
    	$this->router = $router;
    }
    
    public function getFunctions() {
        return array(new \Twig_SimpleFunction('menuButton', array($this,
        		 	'menuButton',
        			array('is_safe' => array('html'))
        )));
    }

    public function menuButton($text, $route = '', $atts = array(), $form = '') {
    	$ret = "<li><a class='main-menu'";
    	if ($route !== '') {
	    	$r = $this->router->generate($route, $atts);
	    	$ret .= " href='$r'";
    	}
    	$ret .= "><button ";
    	
    	if($form !== '') {
    		$ret .= "form='$form' type='submit'";
    	}
    	
    	$ret .=	"class='btn'>".$text."</button>";
    	$ret .= "</a>";
    	$ret .= "</li>";
    			    	
      return $ret;
    }

    public function getName()
    {
        return 'menubutton_extension';
    }
}