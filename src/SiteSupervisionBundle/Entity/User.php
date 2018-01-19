<?php

namespace SiteSupervisionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * User
 *  http://symfony.com/doc/2.8/doctrine/registration_form.html
 * https://symfony.com/doc/current/security/entity_provider.html
 *
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="SiteSupervisionBundle\Repository\UserRepository")
 * @UniqueEntity(fields="email", message="Cet email n'est pas disponible")
 *
 */
class User implements UserInterface
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
     * @ORM\Column(type="string", length=255, unique=true)
     * 
     * @Assert\NotBlank()
     * @Assert\Email(
     *     message = "Cel mail '{{ value }}' n'est pas valide.",
     *     checkMX = true
     * )
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=25, unique=true, nullable=true)
     */
    private $username;


    /**
     * The below length depends on the "algorithm" you use for encoding
     * the password, but this works well with bcrypt.
     *
     * @ORM\Column(type="string", length=64)
     */
    private $password;


    /**
     * @var array
     *
     * @ORM\Column(name="roles", type="array")
     */
    private $roles;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="last_connection", type="datetime")
     */
    private $lastConnection;

    /**
     * @var string
     *
     * @ORM\Column(name="token", type="string", length=255)
     */
    private $token;

    /**
     * @var int
     *
     * @ORM\Column(name="connection_failure", type="integer")
     */
    private $connectionFailure;

    /**
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $isActive;

    /////////////////////////////////////////////////////////////////////////////////////////////////////
    /**
     * @var \SiteSupervisionBundle\Entity\Customer
     *
     * @ORM\OneToOne(targetEntity="\SiteSupervisionBundle\Entity\Customer", mappedBy="user", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="customer_id", referencedColumnName="id")
     */
    private $customer;

    /**
     * @var \SiteSupervisionBundle\Entity\Employee
     *
     * @ORM\OneToOne(targetEntity="\SiteSupervisionBundle\Entity\Employee", mappedBy="user", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="company_id", referencedColumnName="id")
     */
    private $employee;

    ////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function __construct()
    {
        // may not be needed, see section on salt below
        //$this->salt = md5(uniqid('', true));
    }



    /**
     * @return array
     */
    public function getRoles()
    {
        return $this->roles;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getSalt()
    {
        return null;
    }

    public function getUsername()
    {
        return $this->email;
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
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
     * Set email
     *
     * @param string $email
     *
     * @return User
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
     * Set password
     *
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Set roles
     *
     * @param string $roles
     *
     * @return User
     */
    public function setRoles($roles)
    {
        if(is_array($roles)){
            $this->roles = $roles;
        } else {
            $this->roles[] = $roles;
        }


        return $this;
    }

    /**
     * Set lastConnection
     *
     * @param \DateTime $lastConnection
     *
     * @return User
     */
    public function setLastConnection($lastConnection)
    {
        $this->lastConnection = $lastConnection;

        return $this;
    }

    /**
     * Get lastConnection
     *
     * @return \DateTime
     */
    public function getLastConnection()
    {
        return $this->lastConnection;
    }

    /**
     * Set token
     *
     * @param string $token
     *
     * @return User
     */
    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }

    /**
     * Get token
     *
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Set connectionFailure
     *
     * @param integer $connectionFailure
     *
     * @return User
     */
    public function setConnectionFailure($connectionFailure)
    {
        $this->connectionFailure = $connectionFailure;

        return $this;
    }

    /**
     * Get connectionFailure
     *
     * @return integer
     */
    public function getConnectionFailure()
    {
        return $this->connectionFailure;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     *
     * @return User
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * Set customer
     *
     * @param \SiteSupervisionBundle\Entity\Customer $customer
     *
     * @return User
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
     * @return Company
     */
    public function getEmployee()
    {
        return $this->employee;
    }

    /**
     * @param Employee employee
     */
    public function setEmployee(\SiteSupervisionBundle\Entity\Employee $employee)
    {
        $this->employee = $employee;
    }


    /**
     * Set username
     *
     * @param string $username
     *
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }


}