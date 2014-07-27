<?php

namespace Binaerpiloten\MagicBundle\Entity;

use Binaerpiloten\MagicBundle\Entity\Karte;
use Doctrine\ORM\Mapping as ORM;

/**
 * Farbe
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Farbe
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
     * @var string
     *
     * @ORM\Column(name="display", type="string", length=255)
     */
    private $display;
    
    /**
	 * @ORM\ManyToMany(targetEntity="Karte", mappedBy="farbe")
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
     * @return Farbe
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
     * Constructor
     */
    public function __construct()
    {
        $this->karten = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add karten
     *
     * @param \Binaerpiloten\MagicBundle\Entity\Karte $karten
     * @return Farbe
     */
    public function addKarten(\Binaerpiloten\MagicBundle\Entity\Karte $karten)
    {
        $this->karten[] = $karten;

        return $this;
    }

    /**
     * Remove karten
     *
     * @param \Binaerpiloten\MagicBundle\Entity\Karte $karten
     */
    public function removeKarten(\Binaerpiloten\MagicBundle\Entity\Karte $karten)
    {
        $this->karten->removeElement($karten);
    }

    /**
     * Get karten
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getKarten()
    {
        return $this->karten;
    }
    
    public function __toString() {
    	return $this->name;
    }

    /**
     * Add karte_id
     *
     * @param \Binaerpiloten\MagicBundle\Entity\Karte $karteId
     * @return Farbe
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

    /**
     * Set display
     *
     * @param string $display
     * @return Farbe
     */
    public function setDisplay($display)
    {
        $this->display = $display;

        return $this;
    }

    /**
     * Get display
     *
     * @return string 
     */
    public function getDisplay()
    {
        return $this->display;
    }
}
