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
     * @ORM\OneToOne(targetEntity="User")
     * @ORM\JoinColumn(name="work_id", referencedColumnName="id", nullable=true, onDelete="SET NULL")
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

    public function __construct($n) {
    	$this->name = $n;
    	$this->working = null;
    }
    
    public function __toString() {
    	return $this->getName()." (".$this->getId().")";
    }

    /**
     * Set working
     *
     * @param \Binaerpiloten\MagicBundle\Entity\User $working
     * @return BatchItem
     */
    public function setWorking(\Binaerpiloten\MagicBundle\Entity\User $working = null)
    {
        $this->working = $working;

        return $this;
    }

    /**
     * Get working
     *
     * @return \Binaerpiloten\MagicBundle\Entity\User 
     */
    public function getWorking()
    {
        return $this->working;
    }
}
