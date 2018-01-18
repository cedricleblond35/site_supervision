<?php

namespace SiteSupervisionBundle\Entity;


use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


/**
 * Company
 *
 * @ORM\Table(name="company")
 * @ORM\Entity(repositoryClass="SiteSupervisionBundle\Repository\CompanyRepository")
 *
 * @UniqueEntity("email", message="Cet email n'est pas disponible")
 * @UniqueEntity("siret", message="Cet siret n'est pas disponible")
 */
class Company
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
     * @Assert\NotBlank(message="Veuillez donner le nom de l'entreprise")
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse1", type="string", length=255)
     */
    private $adresse1;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse2", type="string", length=255)
     */
    private $adresse2;

    /**
     * @var string
     * @Assert\Regex(
     *     pattern="/^\d{4}\d$/",
     *     match=false,
     *     message="Le numero de téléphone n'est pas valide"
     * )
     * @ORM\Column(name="code_postal", type="string", length=5)
     */
    private $codePostal;

    /**
     * @var string
     * @Assert\Regex(
     *     pattern="/^\d{9}\d$/",
     *     match=false,
     *     message="Le numero de téléphone n'est pas valide"
     * )
     * @ORM\Column(name="telephone", type="string", length=10)

     */
    private $telephonefixe;

    /**
     * @var string
     * @Assert\Email(
     *     message = "Cel mail '{{ value }}' n'est pas valide.",
     *     checkMX = true
     * )
     * @ORM\Column(name="email", type="string", length=255, unique=true)
     */
    private $email;

    /**
     * @var decimal : Il s’agit d’un identifiant formé de 14 chiffres composé du SIREN (9 chiffres) et du NIC (5 chiffres).
     * @Assert\Regex(
     *     pattern="/^\d{13}\d$/",
     *     match=false,
     *     message="Ceci n'est pas un numero de siret valide"
     * )
     * @ORM\Column(name="siret", type="string", length=14, unique=true)
     */
    private $siret;

    /**
     * @var string
     * @Assert\Regex(
     *     pattern="/^\d{4}[a-zA-Z]$/",
     *     match=false,
     *     message="Ceci n'est pas un numero de siret valide"
     * )
     * @ORM\Column(name="ape", type="string", length=9)
     */
    private $ape;

    /**
     * @var string
     *
     * @ORM\Column(name="commentaire", type="text")
     */
    private $commentaire;

    //////////////////////////////////////////////////----------------------------------------------------------
    /**
     * @var \SiteSupervisionBundle\Entity\User
     *
     * @ORM\OneToOne(targetEntity="\SiteSupervisionBundle\Entity\User", mappedBy="compagny")
     */
    private $user;


    /**
     * @var \SiteSupervisionBundle\Entity\Employee
     *
     * @ORM\OneToMany(targetEntity="\SiteSupervisionBundle\Entity\Employee", mappedBy="compagny")
     */
    private $employees;

    /**
     * @var \SiteSupervisionBundle\Entity\VillesFranceFree
     *
     * @ORM\ManyToOne(targetEntity="\SiteSupervisionBundle\Entity\VillesFranceFree", inversedBy="compagnies", cascade={"persist"}))
     *
     */
    private $villesFranceFree;


    /**
     * @var \SiteSupervisionBundle\Entity\Lot
     *
     * @ORM\OneToMany(targetEntity="\SiteSupervisionBundle\Entity\Lot", mappedBy="compagny")
     *
     */
    private $lots;
    //////////////////////////////////////////////////----------------------------------------------------------
    
   
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->employees = new \Doctrine\Common\Collections\ArrayCollection();
        $this->lots = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set nomSociete
     *
     * @param string $nomSociete
     *
     * @return Company
     */
    public function setNomSociete($nomSociete)
    {
        $this->nomSociete = $nomSociete;

        return $this;
    }

    /**
     * Get nomSociete
     *
     * @return string
     */
    public function getNomSociete()
    {
        return $this->nomSociete;
    }

    /**
     * Set adresse1
     *
     * @param string $adresse1
     *
     * @return Company
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
     * @return Company
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
     * Set codePostal
     *
     * @param string $codePostal
     *
     * @return Company
     */
    public function setCodePostal($codePostal)
    {
        $this->codePostal = $codePostal;

        return $this;
    }

    /**
     * Get codePostal
     *
     * @return string
     */
    public function getCodePostal()
    {
        return $this->codePostal;
    }

    /**
     * Set telephonefixe
     *
     * @param string $telephonefixe
     *
     * @return Company
     */
    public function setTelephonefixe($telephonefixe)
    {
        $this->telephonefixe = $telephonefixe;

        return $this;
    }

    /**
     * Get telephonefixe
     *
     * @return string
     */
    public function getTelephonefixe()
    {
        return $this->telephonefixe;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Company
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set siret
     *
     * @param string $siret
     *
     * @return Company
     */
    public function setSiret($siret)
    {
        $this->siret = $siret;

        return $this;
    }

    /**
     * Get siret
     *
     * @return string
     */
    public function getSiret()
    {
        return $this->siret;
    }

    /**
     * Set ape
     *
     * @param string $ape
     *
     * @return Company
     */
    public function setApe($ape)
    {
        $this->ape = $ape;

        return $this;
    }

    /**
     * Get ape
     *
     * @return string
     */
    public function getApe()
    {
        return $this->ape;
    }

    /**
     * Set commentaire
     *
     * @param string $commentaire
     *
     * @return Company
     */
    public function setCommentaire($commentaire)
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    /**
     * Get commentaire
     *
     * @return string
     */
    public function getCommentaire()
    {
        return $this->commentaire;
    }

    /**
     * Set user
     *
     * @param \SiteSupervisionBundle\Entity\User $user
     *
     * @return Company
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
     * Add employee
     *
     * @param \SiteSupervisionBundle\Entity\Employee $employee
     *
     * @return Company
     */
    public function addEmployee(\SiteSupervisionBundle\Entity\Employee $employee)
    {
        $this->employees[] = $employee;

        return $this;
    }

    /**
     * Remove employee
     *
     * @param \SiteSupervisionBundle\Entity\Employee $employee
     */
    public function removeEmployee(\SiteSupervisionBundle\Entity\Employee $employee)
    {
        $this->employees->removeElement($employee);
    }

    /**
     * Get employees
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEmployees()
    {
        return $this->employees;
    }

    /**
     * Set villesFranceFree
     *
     * @param \SiteSupervisionBundle\Entity\VillesFranceFree $villesFranceFree
     *
     * @return Company
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
     * Add lot
     *
     * @param \SiteSupervisionBundle\Entity\Lot $lot
     *
     * @return Company
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
}
