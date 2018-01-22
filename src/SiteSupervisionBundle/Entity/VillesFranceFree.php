<?php

namespace SiteSupervisionBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * VillesFranceFree
 *
 * @ORM\Table(name="villes_france_free", 
 *     uniqueConstraints={ 
 *              @ORM\UniqueConstraint(name="ville_code_commune_2", columns={"ville_code_commune"}) }, 
 *     indexes={
 *              @ORM\Index(name="ville_departement", columns={"ville_departement"}), 
 *              @ORM\Index(name="ville_nom", columns={"ville_nom"}), 
 *              @ORM\Index(name="ville_nom_reel", columns={"ville_nom_reel"}), 
 *              @ORM\Index(name="ville_code_commune", columns={"ville_code_commune"}), 
 *              @ORM\Index(name="ville_code_postal", columns={"ville_code_postal"}), 
 *              @ORM\Index(name="ville_longitude_latitude_deg", columns={"ville_longitude_deg", "ville_latitude_deg"})})
 * 
 * @ORM\Entity(repositoryClass="SiteSupervisionBundle\Repository\VillesFranceFreeRepository")
 */

class VillesFranceFree
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
     * @ORM\Column(name="ville_departement", type="string", length=3, nullable=true)
     */
    private $villeDepartement;
    

    /**
     * @var string
     *
     * @ORM\Column(name="ville_nom", type="string", length=45, nullable=true)
     */
    private $villeNom;

    /**
     * @var string
     *
     * @ORM\Column(name="ville_nom_reel", type="string", length=45, nullable=true)
     */
    private $villeNomReel;

    /**
     * @var string
     *
     * @ORM\Column(name="ville_code_postal", type="string", length=255, nullable=true)
     */
    private $villeCodePostal;

    /**
     * @var string
     *
     * @ORM\Column(name="ville_code_commune", type="string", length=5, nullable=false)
     */
    private $villeCodeCommune;

    /**
     * @var integer
     *
     * @ORM\Column(name="ville_arrondissement", type="smallint", nullable=true)
     */
    private $villeArrondissement;

    /**
     * @var float
     *
     * @ORM\Column(name="ville_longitude_deg", type="float", precision=10, scale=0, nullable=true)
     */
    private $villeLongitudeDeg;

    /**
     * @var float
     *
     * @ORM\Column(name="ville_latitude_deg", type="float", precision=10, scale=0, nullable=true)
     */
    private $villeLatitudeDeg;

    /**
     * @var string
     *
     * @ORM\Column(name="ville_longitude_grd", type="string", length=9, nullable=true)
     */
    private $villeLongitudeGrd;

    /**
     * @var string
     *
     * @ORM\Column(name="ville_latitude_grd", type="string", length=8, nullable=true)
     */
    private $villeLatitudeGrd;

    /**
     * @var string
     *
     * @ORM\Column(name="ville_longitude_dms", type="string", length=9, nullable=true)
     */
    private $villeLongitudeDms;

    /**
     * @var string
     *
     * @ORM\Column(name="ville_latitude_dms", type="string", length=8, nullable=true)
     */
    private $villeLatitudeDms;

    
    ////////////////////-------------------------
    /**
     * @var \SiteSupervisionBundle\Entity\Company
     *
     * @ORM\OneToMany(targetEntity="\SiteSupervisionBundle\Entity\Company", mappedBy="villesFranceFree")
     */
    private $companies;
    /**
     * @var \SiteSupervisionBundle\Entity\Customer
     *
     * @ORM\OneToMany(targetEntity="\SiteSupervisionBundle\Entity\Customer", mappedBy="villesFranceFree", cascade={"persist", "remove"})
     */
    private $customers;
    /**
     * @var \SiteSupervisionBundle\Entity\Construction_site
     *
     * @ORM\OneToMany(targetEntity="\SiteSupervisionBundle\Entity\Construction_site", mappedBy="villesFranceFree")
     */
    private $construction_sites;
    //////////////////////////////////////////////////----------------------------------------------------------
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->companies = new ArrayCollection();
        $this->customers = new ArrayCollection();
        $this->construction_sites = new ArrayCollection();
    }

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
     * Set villeDepartement
     *
     * @param string $villeDepartement
     *
     * @return VillesFranceFree
     */
    public function setVilleDepartement($villeDepartement)
    {
        $this->villeDepartement = $villeDepartement;

        return $this;
    }

    /**
     * Get villeDepartement
     *
     * @return string
     */
    public function getVilleDepartement()
    {
        return $this->villeDepartement;
    }

    /**
     * Set villeNom
     *
     * @param string $villeNom
     *
     * @return VillesFranceFree
     */
    public function setVilleNom($villeNom)
    {
        $this->villeNom = $villeNom;

        return $this;
    }

    /**
     * Get villeNom
     *
     * @return string
     */
    public function getVilleNom()
    {
        return $this->villeNom;
    }

    /**
     * Set villeNomReel
     *
     * @param string $villeNomReel
     *
     * @return VillesFranceFree
     */
    public function setVilleNomReel($villeNomReel)
    {
        $this->villeNomReel = $villeNomReel;

        return $this;
    }

    /**
     * Get villeNomReel
     *
     * @return string
     */
    public function getVilleNomReel()
    {
        return $this->villeNomReel;
    }

    /**
     * Set villeCodePostal
     *
     * @param string $villeCodePostal
     *
     * @return VillesFranceFree
     */
    public function setVilleCodePostal($villeCodePostal)
    {
        $this->villeCodePostal = $villeCodePostal;

        return $this;
    }

    /**
     * Get villeCodePostal
     *
     * @return string
     */
    public function getVilleCodePostal()
    {
        return $this->villeCodePostal;
    }

    /**
     * Set villeCodeCommune
     *
     * @param string $villeCodeCommune
     *
     * @return VillesFranceFree
     */
    public function setVilleCodeCommune($villeCodeCommune)
    {
        $this->villeCodeCommune = $villeCodeCommune;

        return $this;
    }

    /**
     * Get villeCodeCommune
     *
     * @return string
     */
    public function getVilleCodeCommune()
    {
        return $this->villeCodeCommune;
    }

    /**
     * Set villeArrondissement
     *
     * @param integer $villeArrondissement
     *
     * @return VillesFranceFree
     */
    public function setVilleArrondissement($villeArrondissement)
    {
        $this->villeArrondissement = $villeArrondissement;

        return $this;
    }

    /**
     * Get villeArrondissement
     *
     * @return integer
     */
    public function getVilleArrondissement()
    {
        return $this->villeArrondissement;
    }

    /**
     * Set villeLongitudeDeg
     *
     * @param float $villeLongitudeDeg
     *
     * @return VillesFranceFree
     */
    public function setVilleLongitudeDeg($villeLongitudeDeg)
    {
        $this->villeLongitudeDeg = $villeLongitudeDeg;

        return $this;
    }

    /**
     * Get villeLongitudeDeg
     *
     * @return float
     */
    public function getVilleLongitudeDeg()
    {
        return $this->villeLongitudeDeg;
    }

    /**
     * Set villeLatitudeDeg
     *
     * @param float $villeLatitudeDeg
     *
     * @return VillesFranceFree
     */
    public function setVilleLatitudeDeg($villeLatitudeDeg)
    {
        $this->villeLatitudeDeg = $villeLatitudeDeg;

        return $this;
    }

    /**
     * Get villeLatitudeDeg
     *
     * @return float
     */
    public function getVilleLatitudeDeg()
    {
        return $this->villeLatitudeDeg;
    }

    /**
     * Set villeLongitudeGrd
     *
     * @param string $villeLongitudeGrd
     *
     * @return VillesFranceFree
     */
    public function setVilleLongitudeGrd($villeLongitudeGrd)
    {
        $this->villeLongitudeGrd = $villeLongitudeGrd;

        return $this;
    }

    /**
     * Get villeLongitudeGrd
     *
     * @return string
     */
    public function getVilleLongitudeGrd()
    {
        return $this->villeLongitudeGrd;
    }

    /**
     * Set villeLatitudeGrd
     *
     * @param string $villeLatitudeGrd
     *
     * @return VillesFranceFree
     */
    public function setVilleLatitudeGrd($villeLatitudeGrd)
    {
        $this->villeLatitudeGrd = $villeLatitudeGrd;

        return $this;
    }

    /**
     * Get villeLatitudeGrd
     *
     * @return string
     */
    public function getVilleLatitudeGrd()
    {
        return $this->villeLatitudeGrd;
    }

    /**
     * Set villeLongitudeDms
     *
     * @param string $villeLongitudeDms
     *
     * @return VillesFranceFree
     */
    public function setVilleLongitudeDms($villeLongitudeDms)
    {
        $this->villeLongitudeDms = $villeLongitudeDms;

        return $this;
    }

    /**
     * Get villeLongitudeDms
     *
     * @return string
     */
    public function getVilleLongitudeDms()
    {
        return $this->villeLongitudeDms;
    }

    /**
     * Set villeLatitudeDms
     *
     * @param string $villeLatitudeDms
     *
     * @return VillesFranceFree
     */
    public function setVilleLatitudeDms($villeLatitudeDms)
    {
        $this->villeLatitudeDms = $villeLatitudeDms;

        return $this;
    }

    /**
     * Get villeLatitudeDms
     *
     * @return string
     */
    public function getVilleLatitudeDms()
    {
        return $this->villeLatitudeDms;
    }

    /**
     * Add company
     *
     * @param \SiteSupervisionBundle\Entity\Company $compagny
     *
     * @return VillesFranceFree
     */
    public function addCompany(\SiteSupervisionBundle\Entity\Company $company)
    {
        $this->companies[] = $company;

        return $this;
    }

    /**
     * Remove company
     *
     * @param \SiteSupervisionBundle\Entity\Company $company
     */
    public function removeCompany(\SiteSupervisionBundle\Entity\Company $company)
    {
        $this->companies->removeElement($company);
    }

    /**
     * Get compagnies
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCompanies()
    {
        return $this->companies;
    }

    /**
     * Add customer
     *
     * @param \SiteSupervisionBundle\Entity\Customer $customer
     *
     * @return VillesFranceFree
     */
    public function addCustomer(\SiteSupervisionBundle\Entity\Customer $customer)
    {
        $this->customers[] = $customer;

        return $this;
    }

    /**
     * Remove customer
     *
     * @param \SiteSupervisionBundle\Entity\Customer $customer
     */
    public function removeCustomer(\SiteSupervisionBundle\Entity\Customer $customer)
    {
        $this->customers->removeElement($customer);
    }

    /**
     * Get customers
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCustomers()
    {
        return $this->customers;
    }

    /**
     * Add constructionSite
     *
     * @param \SiteSupervisionBundle\Entity\Construction_site $constructionSite
     *
     * @return VillesFranceFree
     */
    public function addConstructionSite(\SiteSupervisionBundle\Entity\Construction_site $constructionSite)
    {
        $this->construction_sites[] = $constructionSite;

        return $this;
    }

    /**
     * Remove constructionSite
     *
     * @param \SiteSupervisionBundle\Entity\Construction_site $constructionSite
     */
    public function removeConstructionSite(\SiteSupervisionBundle\Entity\Construction_site $constructionSite)
    {
        $this->construction_sites->removeElement($constructionSite);
    }

    /**
     * Get constructionSites
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getConstructionSites()
    {
        return $this->construction_sites;
    }

    public function __toString()
    {
        return $this->villeNom;
    }
}
