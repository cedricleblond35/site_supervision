<?php

namespace SiteSupervisionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Type_construction
 *
 * @ORM\Table(name="type_construction")
 * @ORM\Entity(repositoryClass="SiteSupervisionBundle\Repository\Type_constructionRepository")
 */
class Type_construction
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="designation", type="string", length=255)
     */
    private $designation;
    
    ///////////////////////////////////////////////////////////
    /**
     * @var \SiteSupervisionBundle\Entity\Construction_site
     *
     * @ORM\ManyToOne(targetEntity="\SiteSupervisionBundle\Entity\Construction_site", inversedBy="type_constructions", cascade={"remove"})
     *
     */
    private $construction_site;


    

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
     * Set designation
     *
     * @param string $designation
     *
     * @return Type_construction
     */
    public function setDesignation($designation)
    {
        $this->designation = $designation;

        return $this;
    }

    /**
     * Get designation
     *
     * @return string
     */
    public function getDesignation()
    {
        return $this->designation;
    }

    /**
     * Set constructionSite
     *
     * @param \SiteSupervisionBundle\Entity\Type_construction $constructionSite
     *
     * @return Type_construction
     */
    public function setConstructionSite(\SiteSupervisionBundle\Entity\Type_construction $constructionSite = null)
    {
        $this->construction_site = $constructionSite;

        return $this;
    }

    /**
     * Get constructionSite
     *
     * @return \SiteSupervisionBundle\Entity\Type_construction
     */
    public function getConstructionSite()
    {
        return $this->construction_site;
    }
}
