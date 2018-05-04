<?php

namespace SiteSupervisionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Construction_site
 *
 * @ORM\Table(name="construction_site")
 * @ORM\Entity(repositoryClass="SiteSupervisionBundle\Repository\Construction_siteRepository")
 */
class Construction_site
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
     * @Assert\NotBlank()
     *
     * @ORM\Column(name="adresse1", type="string", length=255)
     */
    private $adresse1;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse2", type="string", length=255, nullable=true)
     */
    private $adresse2;

    /**
     * @var int
     *
     * @ORM\Column(name="nbre_pieces", type="smallint", nullable=true)
     */
    private $nbrePieces;

    /**
     * @var int
     *
     * @ORM\Column(name="surface_sol", type="decimal", precision=6, scale=2, nullable=true)
     */
    private $surfaceSol;

    /**
     * @var int
     *
     * @ORM\Column(name="surface_habitable", type="decimal", precision=6, scale=2, nullable=true)
     *
     */
    private $surfaceHabitable;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_debut", type="date", nullable=true)
     */
    private $dateDebut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_fin", type="date", nullable=true)
     */
    private $dateFin;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_debut_previ", type="date", nullable=true)
     */
    private $dateDebutPrevi;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_fin_previ", type="date", nullable=true)
     */
    private $dateFinPrevi;


    /**
     * @var string
     *
     * @ORM\Column(name="lien_cctp", type="string", length=255, nullable=true)
     */
    private $lien_cctp;

    /**
     * @var string
     *
     * @ORM\Column(name="lien_plans", type="string", length=255, nullable=true)
     */
    private $lien_plans;

    /**
     * @var string
     *
     * @ORM\Column(name="lien_devis", type="string", length=255, nullable=true)
     */
    private $lien_devis;

    //////////////////////////////////////////////////----------------------------------------------------------



    /**
     * @var \SiteSupervisionBundle\Entity\Lot
     *
     * @ORM\ManyToMany(targetEntity="\SiteSupervisionBundle\Entity\Lot")
     *
     */
    private $lots;


    /**
     * @var \SiteSupervisionBundle\Entity\General_comment
     *
     * @ORM\OneToMany(targetEntity="\SiteSupervisionBundle\Entity\General_comment", mappedBy="construction_site")
     *
     */
    private $general_comments;
    
    /**
     * @var \SiteSupervisionBundle\Entity\Type_construction
     *
     * @ORM\OneToMany(targetEntity="\SiteSupervisionBundle\Entity\Type_construction", mappedBy="construction_site")
     *
     */
    private $type_constructions;

    /**
     * @var \SiteSupervisionBundle\Entity\VillesFranceFree
     *
     * @ORM\ManyToOne(
     *     targetEntity="\SiteSupervisionBundle\Entity\VillesFranceFree",
     *     inversedBy="construction_sites", cascade={"all"}, fetch="EAGER")
     * @ORM\JoinColumn(name="villes_france_free_id", referencedColumnName="id")
     *
     */
    private $villesFranceFree;

    /**
     * @var \SiteSupervisionBundle\Entity\Customer
     *
     * @ORM\ManyToOne(targetEntity="\SiteSupervisionBundle\Entity\Customer", inversedBy="customers_of_contruction_site")
     *
     */
    private $customer;
    /**
     * @var \SiteSupervisionBundle\Entity\File
     * @ORM\OneToMany(targetEntity="\SiteSupervisionBundle\Entity\File", mappedBy="contruction_site")
     *
     */
    private $attached_files;
    //////////////////////////////////////////////////----------------------------------------------------------
    
    

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->lots = new \Doctrine\Common\Collections\ArrayCollection();
        $this->general_comments = new \Doctrine\Common\Collections\ArrayCollection();
        $this->type_constructions = new \Doctrine\Common\Collections\ArrayCollection();
        $this->attached_files = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set adresse1
     *
     * @param string $adresse1
     *
     * @return Construction_site
     */
    public function setAdresse1($adresse1)
    {
        $this->adresse1 = $adresse1;

        return $this;
    }

    /**
     * Get adresse1
     *
     * @return string
     */
    public function getAdresse1()
    {
        return $this->adresse1;
    }

    /**
     * Set adresse2
     *
     * @param string $adresse2
     *
     * @return Construction_site
     */
    public function setAdresse2($adresse2)
    {
        $this->adresse2 = $adresse2;

        return $this;
    }

    /**
     * Get adresse2
     *
     * @return string
     */
    public function getAdresse2()
    {
        return $this->adresse2;
    }

    /**
     * Set nbrePieces
     *
     * @param integer $nbrePieces
     *
     * @return Construction_site
     */
    public function setNbrePieces($nbrePieces)
    {
        $this->nbrePieces = $nbrePieces;

        return $this;
    }

    /**
     * Get nbrePieces
     *
     * @return integer
     */
    public function getNbrePieces()
    {
        return $this->nbrePieces;
    }

    /**
     * Set surfaceSol
     *
     * @param string $surfaceSol
     *
     * @return Construction_site
     */
    public function setSurfaceSol($surfaceSol)
    {
        $this->surfaceSol = $surfaceSol;

        return $this;
    }

    /**
     * Get surfaceSol
     *
     * @return string
     */
    public function getSurfaceSol()
    {
        return $this->surfaceSol;
    }

    /**
     * Set surfaceHabitable
     *
     * @param string $surfaceHabitable
     *
     * @return Construction_site
     */
    public function setSurfaceHabitable($surfaceHabitable)
    {
        $this->surfaceHabitable = $surfaceHabitable;

        return $this;
    }

    /**
     * Get surfaceHabitable
     *
     * @return string
     */
    public function getSurfaceHabitable()
    {
        return $this->surfaceHabitable;
    }

    /**
     * Set dateDebut
     *
     * @param \DateTime $dateDebut
     *
     * @return Construction_site
     */
    public function setDateDebut($dateDebut)
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    /**
     * Get dateDebut
     *
     * @return \DateTime
     */
    public function getDateDebut()
    {
        return $this->dateDebut;
    }

    /**
     * Set dateFin
     *
     * @param \DateTime $dateFin
     *
     * @return Construction_site
     */
    public function setDateFin($dateFin)
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    /**
     * Get dateFin
     *
     * @return \DateTime
     */
    public function getDateFin()
    {
        return $this->dateFin;
    }

    /**
     * Set dateDebutPrevi
     *
     * @param \DateTime $dateDebutPrevi
     *
     * @return Construction_site
     */
    public function setDateDebutPrevi($dateDebutPrevi)
    {
        $this->dateDebutPrevi = $dateDebutPrevi;

        return $this;
    }

    /**
     * Get dateDebutPrevi
     *
     * @return \DateTime
     */
    public function getDateDebutPrevi()
    {
        return $this->dateDebutPrevi;
    }

    /**
     * Set dateFinPrevi
     *
     * @param \DateTime $dateFinPrevi
     *
     * @return Construction_site
     */
    public function setDateFinPrevi($dateFinPrevi)
    {
        $this->dateFinPrevi = $dateFinPrevi;

        return $this;
    }

    /**
     * Get dateFinPrevi
     *
     * @return \DateTime
     */
    public function getDateFinPrevi()
    {
        return $this->dateFinPrevi;
    }

    /**
     * Set lienCctp
     *
     * @param string $lienCctp
     *
     * @return Construction_site
     */
    public function setLienCctp($lienCctp)
    {
        $this->lien_cctp = $lienCctp;

        return $this;
    }

    /**
     * Get lienCctp
     *
     * @return string
     */
    public function getLienCctp()
    {
        return $this->lien_cctp;
    }

    /**
     * Set lienPlans
     *
     * @param string $lienPlans
     *
     * @return Construction_site
     */
    public function setLienPlans($lienPlans)
    {
        $this->lien_plans = $lienPlans;

        return $this;
    }

    /**
     * Get lienPlans
     *
     * @return string
     */
    public function getLienPlans()
    {
        return $this->lien_plans;
    }

    /**
     * Set lienDevis
     *
     * @param string $lienDevis
     *
     * @return Construction_site
     */
    public function setLienDevis($lienDevis)
    {
        $this->lien_devis = $lienDevis;

        return $this;
    }

    /**
     * Get lienDevis
     *
     * @return string
     */
    public function getLienDevis()
    {
        return $this->lien_devis;
    }

    /**
     * Add lot
     *
     * @param \SiteSupervisionBundle\Entity\Lot $lot
     *
     * @return Construction_site
     */
    public function addLot(\SiteSupervisionBundle\Entity\Lot $lot)
    {
        $this->lots[] = $lot;

        return $this;
    }

    /**
     * Remove lot
     *
     * @param \SiteSupervisionBundle\Entity\Lot $lot
     */
    public function removeLot(\SiteSupervisionBundle\Entity\Lot $lot)
    {
        $this->lots->removeElement($lot);
    }

    /**
     * Get lots
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLots()
    {
        return $this->lots;
    }

    /**
     * Add generalComment
     *
     * @param \SiteSupervisionBundle\Entity\General_comment $generalComment
     *
     * @return Construction_site
     */
    public function addGeneralComment(\SiteSupervisionBundle\Entity\General_comment $generalComment)
    {
        $this->general_comments[] = $generalComment;

        return $this;
    }

    /**
     * Remove generalComment
     *
     * @param \SiteSupervisionBundle\Entity\General_comment $generalComment
     */
    public function removeGeneralComment(\SiteSupervisionBundle\Entity\General_comment $generalComment)
    {
        $this->general_comments->removeElement($generalComment);
    }

    /**
     * Get generalComments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getGeneralComments()
    {
        return $this->general_comments;
    }

    /**
     * Add typeConstruction
     *
     * @param \SiteSupervisionBundle\Entity\Type_construction $typeConstruction
     *
     * @return Construction_site
     */
    public function addTypeConstruction(\SiteSupervisionBundle\Entity\Type_construction $typeConstruction)
    {
        $this->type_constructions[] = $typeConstruction;

        return $this;
    }

    /**
     * Remove typeConstruction
     *
     * @param \SiteSupervisionBundle\Entity\Type_construction $typeConstruction
     */
    public function removeTypeConstruction(\SiteSupervisionBundle\Entity\Type_construction $typeConstruction)
    {
        $this->type_constructions->removeElement($typeConstruction);
    }

    /**
     * Get typeConstructions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTypeConstructions()
    {
        return $this->type_constructions;
    }

    /**
     * Set villesFranceFree
     *
     * @param \SiteSupervisionBundle\Entity\VillesFranceFree $villesFranceFree
     *
     * @return Construction_site
     */
    public function setVillesFranceFree(\SiteSupervisionBundle\Entity\VillesFranceFree $villesFranceFree = null)
    {
        $this->villesFranceFree = $villesFranceFree;

        return $this;
    }

    /**
     * Get villesFranceFree
     *
     * @return \SiteSupervisionBundle\Entity\VillesFranceFree
     */
    public function getVillesFranceFree()
    {
        return $this->villesFranceFree;
    }

    /**
     * Set customer
     *
     * @param \SiteSupervisionBundle\Entity\Customer $customer
     *
     * @return Construction_site
     */
    public function setCustomer(\SiteSupervisionBundle\Entity\Customer $customer = null)
    {
        $this->customer = $customer;

        return $this;
    }

    /**
     * Get customer
     *
     * @return \SiteSupervisionBundle\Entity\Customer
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * Add attachedFile
     *
     * @param \SiteSupervisionBundle\Entity\File $attachedFile
     *
     * @return Construction_site
     */
    public function addAttachedFile(\SiteSupervisionBundle\Entity\File $attachedFile)
    {
        $this->attached_files[] = $attachedFile;

        return $this;
    }

    /**
     * Remove attachedFile
     *
     * @param \SiteSupervisionBundle\Entity\File $attachedFile
     */
    public function removeAttachedFile(\SiteSupervisionBundle\Entity\File $attachedFile)
    {
        $this->attached_files->removeElement($attachedFile);
    }

    /**
     * Get attachedFiles
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAttachedFiles()
    {
        return $this->attached_files;
    }
}
