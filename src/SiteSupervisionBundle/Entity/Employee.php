<?php

namespace SiteSupervisionBundle\Entity;


use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;



/**
 * Employee
 *
 * @ORM\Table(name="employee")
 * @ORM\Entity(repositoryClass="SiteSupervisionBundle\Repository\EmployeeRepository")
 *
 *
 * @UniqueEntity("telephonePortable", message="Ce téléphone n'est pas disponible")
 * @UniqueEntity("email", message="Cet email n'est pas disponible")
 */
class Employee
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
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=255)
     */
    private $prenom;

    /**
     * @var string
     * @Assert\Regex(
     *     pattern="/^\d{9}\d$/",
     *     match=false,
     *     message="Ceci n'est pas un numero de siret valide"
     * )
     * @ORM\Column(name="telephone_portable", type="string", length=255, unique=true)
     */
    private $telephonePortable;

    /**
     * @var string
     *
     * @Assert\Email(message="Votre e-mail ne correspond à un email")
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    //////////////////////////////////////////////
    /**
     * @var \SiteSupervisionBundle\Entity\Company
     *
     * @ORM\ManyToOne(targetEntity="\SiteSupervisionBundle\Entity\Company", inversedBy="employees", cascade={"remove"})
     * @ORM\JoinColumn(nullable=false)
     *
     */
    private $compagny;


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
     * @return Employee
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
     * @return Employee
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
     * @return Employee
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
     * Set email
     *
     * @param string $email
     *
     * @return Employee
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
     * Set compagny
     *
     * @param \SiteSupervisionBundle\Entity\Company $compagny
     *
     * @return Employee
     */
    public function setCompagny(\SiteSupervisionBundle\Entity\Company $compagny)
    {
        $this->compagny = $compagny;

        return $this;
    }

    /**
     * Get compagny
     *
     * @return \SiteSupervisionBundle\Entity\Company
     */
    public function getCompagny()
    {
        return $this->compagny;
    }
}
