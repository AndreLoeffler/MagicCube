<?php

namespace Binaerpiloten\MagicBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Karte
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Karte
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
     * @ORM\Column(name="anzahl", type="integer")
     */
    private $anzahl;

    /**
     * @ORM\Column(name="mana", type="integer")
     */
    private $mana;
    
    
    /**
     * @ORM\ManyToMany(targetEntity="Farbe", inversedBy="karte_id")
     * @ORM\JoinTable(name="karte_farbe")
     */
    private $farbe;

    /**
     * @ORM\ManyToMany(targetEntity="Typ", inversedBy="karte_id")
     * @ORM\JoinTable(name="karte_typ")
     */
    private $typ;
    
    /**
     * @ORM\ManyToOne(targetEntity="Seltenheit", inversedBy="karte_id")
     * @ORM\JoinColumn(name="karte_seltenheit", referencedColumnName="id")
     */
    private $seltenheit;

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
     * @return Karte
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
     * Set anzahl
     *
     * @param string $anzahl
     * @return Karte
     */
    public function setAnzahl($anzahl)
    {
        $this->anzahl = $anzahl;

        return $this;
    }

    /**
     * Get anzahl
     *
     * @return string 
     */
    public function getAnzahl()
    {
        return $this->anzahl;
    }

    /**
     * Set typ
     *
     * @param \stdClass $typ
     * @return Karte
     */
    public function setTyp($typ)
    {
        $this->typ = $typ;

        return $this;
    }

    /**
     * Get typ
     *
     * @return \stdClass 
     */
    public function getTyp()
    {
        return $this->typ;
    }

    /**
     * Set stichwort
     *
     * @param \stdClass $stichwort
     * @return Karte
     */
    public function setStichwort($stichwort)
    {
        $this->stichwort = $stichwort;

        return $this;
    }

    /**
     * Get stichwort
     *
     * @return \stdClass 
     */
    public function getStichwort()
    {
        return $this->stichwort;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->farbe = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add farbe
     *
     * @param \Binaerpiloten\MagicBundle\Entity\Farbe $farbe
     * @return Karte
     */
    public function addFarbe(\Binaerpiloten\MagicBundle\Entity\Farbe $farbe)
    {
        $this->farbe[] = $farbe;

        return $this;
    }

    /**
     * Remove farbe
     *
     * @param \Binaerpiloten\MagicBundle\Entity\Farbe $farbe
     */
    public function removeFarbe(\Binaerpiloten\MagicBundle\Entity\Farbe $farbe)
    {
        $this->farbe->removeElement($farbe);
    }
    
    public function __toString() {
    	return $this->name;
    }

    /**
     * Get farbe
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFarbe()
    {
        return $this->farbe;
    }

    /**
     * Add typ
     *
     * @param \Binaerpiloten\MagicBundle\Entity\Typ $typ
     * @return Karte
     */
    public function addTyp(\Binaerpiloten\MagicBundle\Entity\Typ $typ)
    {
        $this->typ[] = $typ;

        return $this;
    }

    /**
     * Remove typ
     *
     * @param \Binaerpiloten\MagicBundle\Entity\Typ $typ
     */
    public function removeTyp(\Binaerpiloten\MagicBundle\Entity\Typ $typ)
    {
        $this->typ->removeElement($typ);
    }



    /**
     * Set seltenheit
     *
     * @param \Binaerpiloten\MagicBundle\Entity\Seltenheit $seltenheit
     * @return Karte
     */
    public function setSeltenheit(\Binaerpiloten\MagicBundle\Entity\Seltenheit $seltenheit = null)
    {
        $this->seltenheit = $seltenheit;

        return $this;
    }

    /**
     * Get seltenheit
     *
     * @return \Binaerpiloten\MagicBundle\Entity\Seltenheit 
     */
    public function getSeltenheit()
    {
        return $this->seltenheit;
    }

    /**
     * Set mana
     *
     * @param integer $mana
     * @return Karte
     */
    public function setMana($mana)
    {
        $this->mana = $mana;

        return $this;
    }

    /**
     * Get mana
     *
     * @return integer 
     */
    public function getMana()
    {
        return $this->mana;
    }
}
