<?php

namespace Binaerpiloten\MagicBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Default controller.
 *
 * @Route("/")
 */
class DefaultController extends Controller
{
	
	/**
	 * Prepares gauges and info.
	 *
	 * @Route("/", name="home")
	 * @Method("GET")
	 * @Template("BinaerpilotenMagicBundle:Main:main.html.twig")
	 */
    public function indexAction() {
    	$em = $this->getDoctrine()->getManager();

    	$karten = $em->createQuery("SELECT  u " .
    			"FROM Binaerpiloten\MagicBundle\Entity\Karte u ")->getResult();
		
    	$farben = $this->farbenGauge($karten, $em);
    	$selten = $this->rarityGauge($karten, $em);
    	$typen = $this->typGauge($karten, $em);
    	$mana = $this->manaGauge($karten, $em);
 
        return array(
            'farben' => $farben,
        	'selten' => $selten,
        	'typen' => $typen,
        	'mana' => $mana,
        );
    }
    
    /**
     * Kontakt page.
     *
     * @Route("/kontakt", name="kontakt")
     * @Method("GET")
     * @Template("BinaerpilotenMagicBundle:Main:kontakt.html.twig")
     */
    public function kontaktAction() {
    
    	return array(
    			
    	);
    }

    /**
     * Impressum page.
     *
     * @Route("/impressum", name="impressum")
     * @Method("GET")
     * @Template("BinaerpilotenMagicBundle:Main:impressum.html.twig")
     */
    public function impressumAction() {
    
    	return array(
    			 
    	);
    }
    
    /**
     * * * * * * * * * * * Santas Little Helpers * * * * * * * * * * * * * * * * * * 
     */
    
    private function farbenGauge($karten, $em) {
    	$farben = $em->createQuery("SELECT  u " .
    			"FROM Binaerpiloten\MagicBundle\Entity\Farbe u ")->getResult();
    	 
    	$entities = array();
    	$i = 0;
    	 
    	foreach ($farben as $f) {
    		$n = $f->getName();
    		$entities[$n]['count'] = 0;
    		$entities[$n]['color'] = $f->getDisplay(); 
    		$entities[$n]['slice'] = $i;
    		$i++;
    	}
    	 
    	foreach ($karten as $k) {
    		$farben = $k->getFarbe();
    		foreach ($farben as $f){
    			$ind = "".$f->getName();
    			$count = (1 / sizeof($farben)) * $k->getAnzahl();
    			$entities[$ind]['count'] += $count;
    		}
    	}
    	
    	return $entities;
    }

    private function typGauge($karten, $em) {
    	$typen = $em->createQuery("SELECT  u " .
    			"FROM Binaerpiloten\MagicBundle\Entity\Typ u ")->getResult();
    
    	$entities = array();
    	$i = 0;
    
    	foreach ($typen as $f) {
    		$n = $f->getName();
    		$entities[$n]['count'] = 0;
    		$entities[$n]['slice'] = $i;
    		$i++;
    	}
    
    	foreach ($karten as $k) {
    		$typ = $k->getTyp();
    		foreach ($typ as $f){
    			$count = (1 / sizeof($typ)) * $k->getAnzahl();
    			$entities[$f->getName()]['count'] += $count;
    		}
    	}
    	 
    	return $entities;
    }    
    
    private function rarityGauge($karten, $em) {
    	$seltenheiten = $em->createQuery("SELECT  u " .
    			"FROM Binaerpiloten\MagicBundle\Entity\Seltenheit u ")->getResult();
    	
    	$entities = array();
    	$i = 0;
    	
    	foreach ($seltenheiten as $f) {
    		$n = $f->getName();
    		$entities[$n]['count'] = 0;
    		$entities[$n]['color'] = $f->getDisplay();
    		$entities[$n]['slice'] = $i;
    		$i++;
    	}
    	
    	foreach ($karten as $k) {
    		$entities[$k->getSeltenheit()->getName()]['count'] += $k->getAnzahl();
    	}
    	 
    	return $entities;
    }
    
    private function manaGauge($karten, $em) {
        $farben = $em->createQuery("SELECT  u " .
    		"FROM Binaerpiloten\MagicBundle\Entity\Farbe u ")->getResult();
    	 
    	$entities = array();
    	for ($i = 0 ; $i < 8 ; $i++ ){
	    	foreach ($farben as $f) {
	    		$n = $f->getName();
	    		$entities[$i][$n]['count'] = 0;
	    		$entities[$i][$n]['color'] = $f->getDisplay(); 
	    		$entities[$i][$n]['slice'] = $i;
	    	}
    	}
    	foreach ($karten as $k){
    		foreach ($k->getFarbe() as $f) {
    			$ind = $k->getMana();
    			if ($ind > 6) $ind = 7;
    			$entities[$ind][$f->getName()]['count'] += 1 / sizeof($k->getFarbe());
    		}
    	}
    	return $entities;
    }
}
