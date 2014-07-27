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
}
