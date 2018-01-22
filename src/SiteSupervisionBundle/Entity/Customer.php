<?php

namespace SiteSupervisionBundle\Entity;


use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


/**
 * Customer
 *
 * @ORM\Table(name="customer")
 * @ORM\Entity(repositoryClass="SiteSupervisionBundle\Repository\CustomerRepository")
 *
 *
 * Pour empêcher un nouvel client de s'enregistrer en utilisant:
 * ---------------------------------------------------------------------
 * @UniqueEntity("telephonePortable", message="Ce téléphone n'est pas disponible")
 */
class Customer
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
     * @Assert\NotBlank(message="Veuillez donner un nom à votre client")
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     * 
     * @ORM\Column(name="prenom", type="string", length=255, nullable=true)
     */
    private $prenom;

    /**
     * @var string
     *
     *     pattern="/^(?:(?:\+|00)33|0)\s*[1-9](?:[\s.-]*\d{2}){4}$/",
     *     match=false,
     *     message="Le numero de téléphone n'est pas valide"
     *
     * @ORM\Column(name="telephone_portable", type="string", length=14, unique=true, nullable=true)
     */
    private $telephonePortable;

    /**
     * @var string
     * ancien : pattern="/^\d{9}\d$/",

     *
     * @ORM\Column(name="telephone_fixe", type="string", length=14, nullable=true)
     */
    private $telephoneFixe;



    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_naissance", type="date")
     */
    private $dateNaissance;

    /**
     * @var string
     *
     * @ORM\Column(name="civilite", type="string", length=5, nullable=true)
     */
    private $civilite;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse1", type="string", length=255, nullable=true)
     */
    private $adresse1;


    /**
     * @var string
     *
     * @ORM\Column(name="adresse2", type="string", length=255, nullable=true)
     */
    private $adresse2;

    /**
     * @var string
     *
     * @ORM\Column(name="pmr", type="boolean")
     */
    private $pmr;

    /**
     * @var string
     *
     * @ORM\Column(name="note", type="text", nullable=true)
     */
    private $note;

    

    //////////////////////////////////////////////////----------------------------------------------------------
    /**
     * @var \SiteSupervisionBundle\Entity\User
     *
     * @ORM\OneToOne(targetEntity="\SiteSupervisionBundle\Entity\User",inversedBy="customer", cascade={"ALL"}, cascade={"all"}, fetch="EAGER")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * 
     */
    private $user;
    
    /**
     * @var \SiteSupervisionBundle\Entity\Construction_site
     *
     * @ORM\OneToMany(targetEntity="\SiteSupervisionBundle\Entity\Construction_site", mappedBy="customer", cascade={"ALL"})
     *
     */
    private $customers_of_contruction_site;

    /**
     * @var \SiteSupervisionBundle\Entity\VillesFranceFree
     *
     * @ORM\ManyToOne(
     *     targetEntity="\SiteSupervisionBundle\Entity\VillesFranceFree",
     *     inversedBy="customers", cascade={"all"}, fetch="EAGER")
     * @ORM\JoinColumn(name="villes_france_free_id", referencedColumnName="id")
     *
     */
    private $villesFranceFree;
    //////////////////////////////////////////////////----------------------------------------------------------


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->customers_of_contruction_site = new \Doctrine\Common\Collections\ArrayCollection();

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
     * Set nom
     *
     * @param string $nom
     *
     * @return Customer
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     *
     * @return Customer
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set telephonePortable
     *
     * @param string $telephonePortable
     *
     * @return Customer
     */
    public function setTelephonePortable($telephonePortable)
    {
        $this->telephonePortable = $telephonePortable;

        return $this;
    }

    /**
     * Get telephonePortable
     *
     * @return string
     */
    public function getTelephonePortable()
    {
        return $this->telephonePortable;
    }

    /**
     * Set telephoneFixe
     *
     * @param string $telephoneFixe
     *
     * @return Customer
     */
    public function setTelephoneFixe($telephoneFixe)
    {
        $this->telephoneFixe = $telephoneFixe;

        return $this;
    }

    /**
     * Get telephoneFixe
     *
     * @return string
     */
    public function getTelephoneFixe()
    {
        return $this->telephoneFixe;
    }


    /**
     * Set dateNaissance
     *
     * @param \DateTime $dateNaissance
     *
     * @return Customer
     */
    public function setDateNaissance($dateNaissance)
    {
        $this->dateNaissance = $dateNaissance;

        return $this;
    }

    /**
     * Get dateNaissance
     *
     * @return \DateTime
     */
    public function getDateNaissance()
    {
        return $this->dateNaissance;
    }

    /**
     * Set civilite
     *
     * @param string $civilite
     *
     * @return Customer
     */
    public function setCivilite($civilite)
    {
        $this->civilite = $civilite;

        return $this;
    }

    /**
     * Get civilite
     *
     * @return string
     */
    public function getCivilite()
    {
        return $this->civilite;
    }

    /**
     * Set adresse1
     *
     * @param string $adresse1
     *
     * @return Customer
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
     * @return Customer
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
     * Set pmr
     *
     * @param boolean $pmr
     *
     * @return Customer
     */
    public function setPmr($pmr)
    {
        $this->pmr = $pmr;

        return $this;
    }

    /**
     * Get pmr
     *
     * @return boolean
     */
    public function getPmr()
    {
        return $this->pmr;
    }

    /**
     * Set note
     *
     * @param string $note
     *
     * @return Customer
     */
    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }

    /**
     * Get note
     *
     * @return string
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * Set user
     *
     * @param \SiteSupervisionBundle\Entity\User $user
     *
     * @return Customer
     */
    public function setUser(\SiteSupervisionBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \SiteSupervisionBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Add customersOfContructionSite
     *
     * @param \SiteSupervisionBundle\Entity\Construction_site $customersOfContructionSite
     *
     * @return Customer
     */
    public function addCustomersOfContructionSite(\SiteSupervisionBundle\Entity\Construction_site $customersOfContructionSite)
    {
        $this->customers_of_contruction_site[] = $customersOfContructionSite;

        return $this;
    }

    /**
     * Remove customersOfContructionSite
     *
     * @param \SiteSupervisionBundle\Entity\Construction_site $customersOfContructionSite
     */
    public function removeCustomersOfContructionSite(\SiteSupervisionBundle\Entity\Construction_site $customersOfContructionSite)
    {
        $this->customers_of_contruction_site->removeElement($customersOfContructionSite);
    }

    /**
     * Get customersOfContructionSite
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCustomersOfContructionSite()
    {
        return $this->customers_of_contruction_site;
    }

    /**
     * Set villesFranceFree
     *
     * @param \SiteSupervisionBundle\Entity\VillesFranceFree $villesFranceFree
     *
     * @return Customer
     */
    public function setVillesFranceFree(\SiteSupervisionBundle\Entity\VillesFranceFree $villesFranceFree)
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
    
}
