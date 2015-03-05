<?php

namespace Binaerpiloten\MagicBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BatchItem
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class BatchItem
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var boolean
     *
     * @ORM\Column(name="working", type="boolean")
     */
    private $working;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return BatchItem
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set working
     *
     * @param boolean $working
     * @return BatchItem
     */
    public function setWorking($working)
    {
        $this->working = $working;

        return $this;
    }

    /**
     * Get working
     *
     * @return boolean 
     */
    public function getWorking()
    {
        return $this->working;
    }
    
    public function __construct($n) {
    	$this->name = $n;
    	$this->working = false;
    }
    
    public function __toString() {
    	return $this->getName()." (".$this->getId().")";
    }
}
