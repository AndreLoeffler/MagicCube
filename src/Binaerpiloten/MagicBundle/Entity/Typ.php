<?php

namespace Binaerpiloten\MagicBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Typ
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Typ
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
     * @ORM\ManyToMany(targetEntity="Karte", mappedBy="typ")
     */
    private $karte_id;

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
     * @return Typ
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
    
    public function __toString() {
    	return $this->name;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->karte_id = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add karte_id
     *
     * @param \Binaerpiloten\MagicBundle\Entity\Karte $karteId
     * @return Typ
     */
    public function addKarteId(\Binaerpiloten\MagicBundle\Entity\Karte $karteId)
    {
        $this->karte_id[] = $karteId;

        return $this;
    }

    /**
     * Remove karte_id
     *
     * @param \Binaerpiloten\MagicBundle\Entity\Karte $karteId
     */
    public function removeKarteId(\Binaerpiloten\MagicBundle\Entity\Karte $karteId)
    {
        $this->karte_id->removeElement($karteId);
    }

    /**
     * Get karte_id
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getKarteId()
    {
        return $this->karte_id;
    }
}
