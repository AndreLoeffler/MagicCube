<?php

namespace Binaerpiloten\MagicBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * KarteFilter
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class KarteFilter
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
     * @ORM\ManyToMany(targetEntity="Typ")
     */
    protected $typ;
    
    /**
     * @ORM\ManyToMany(targetEntity="Farbe")
     */
    protected $farbe;
    
    /**
     * @ORM\ManyToMany(targetEntity="Seltenheit")
     */
    protected $seltenheit;
    
    /**
     * @ORM\ManyToMany(targetEntity="Edition")
     */
    protected $edition;


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
     * Constructor
     */
    public function __construct()
    {
        $this->typ = new \Doctrine\Common\Collections\ArrayCollection();
        $this->farbe = new \Doctrine\Common\Collections\ArrayCollection();
        $this->seltenheit = new \Doctrine\Common\Collections\ArrayCollection();
        $this->edition = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add typ
     *
     * @param \Binaerpiloten\MagicBundle\Entity\Typ $typ
     * @return KarteFilter
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
     * Get typ
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTyp()
    {
        return $this->typ;
    }

    /**
     * Add farbe
     *
     * @param \Binaerpiloten\MagicBundle\Entity\Farbe $farbe
     * @return KarteFilter
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
     * Add seltenheit
     *
     * @param \Binaerpiloten\MagicBundle\Entity\Seltenheit $seltenheit
     * @return KarteFilter
     */
    public function addSeltenheit(\Binaerpiloten\MagicBundle\Entity\Seltenheit $seltenheit)
    {
        $this->seltenheit[] = $seltenheit;

        return $this;
    }

    /**
     * Remove seltenheit
     *
     * @param \Binaerpiloten\MagicBundle\Entity\Seltenheit $seltenheit
     */
    public function removeSeltenheit(\Binaerpiloten\MagicBundle\Entity\Seltenheit $seltenheit)
    {
        $this->seltenheit->removeElement($seltenheit);
    }

    /**
     * Get seltenheit
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSeltenheit()
    {
        return $this->seltenheit;
    }

    /**
     * Add edition
     *
     * @param \Binaerpiloten\MagicBundle\Entity\Edition $edition
     * @return KarteFilter
     */
    public function addEdition(\Binaerpiloten\MagicBundle\Entity\Edition $edition)
    {
        $this->edition[] = $edition;

        return $this;
    }

    /**
     * Remove edition
     *
     * @param \Binaerpiloten\MagicBundle\Entity\Edition $edition
     */
    public function removeEdition(\Binaerpiloten\MagicBundle\Entity\Edition $edition)
    {
        $this->edition->removeElement($edition);
    }

    /**
     * Get edition
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEdition()
    {
        return $this->edition;
    }
}
