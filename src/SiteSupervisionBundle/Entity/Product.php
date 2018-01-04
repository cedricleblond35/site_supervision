<?php

namespace SiteSupervisionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Product
 *
 * @ORM\Table(name="product")
 * @ORM\Entity(repositoryClass="SiteSupervisionBundle\Repository\ProductRepository")
 */
class Product
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
     * @Assert\NotBlank(message="Veuillez donner un nom au produit")
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;
    
    /**
     * @var string
     *
     * @ORM\Column(name="lien", type="string", length=255)
     */
    private $lien;

    /**
     * @var string
     *
     * @ORM\Column(name="type_lien", type="string", length=255)
     */
    private $typeLien;
    
    /**
     * @var \SiteSupervisionBundle\Entity\File
     * @ORM\OneToMany(targetEntity="\SiteSupervisionBundle\Entity\File", mappedBy="product")
     *
     */
    private $attached_files;


    /////////////////////////////////////////////////////////////

    /**
     * @var \SiteSupervisionBundle\Entity\Article
     *
     * @ORM\ManyToOne(targetEntity="\SiteSupervisionBundle\Entity\Article", inversedBy="products")
     *
     */
    private $article;


    /**
     * Constructor
     */
    public function __construct()
    {
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
     * Set nom
     *
     * @param string $nom
     *
     * @return Product
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
     * Set description
     *
     * @param string $description
     *
     * @return Product
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set lien
     *
     * @param string $lien
     *
     * @return Product
     */
    public function setLien($lien)
    {
        $this->lien = $lien;

        return $this;
    }

    /**
     * Get lien
     *
     * @return string
     */
    public function getLien()
    {
        return $this->lien;
    }

    /**
     * Set typeLien
     *
     * @param string $typeLien
     *
     * @return Product
     */
    public function setTypeLien($typeLien)
    {
        $this->typeLien = $typeLien;

        return $this;
    }

    /**
     * Get typeLien
     *
     * @return string
     */
    public function getTypeLien()
    {
        return $this->typeLien;
    }

    /**
     * Add attachedFile
     *
     * @param \SiteSupervisionBundle\Entity\File $attachedFile
     *
     * @return Product
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

    /**
     * Set article
     *
     * @param \SiteSupervisionBundle\Entity\Article $article
     *
     * @return Product
     */
    public function setArticle(\SiteSupervisionBundle\Entity\Article $article = null)
    {
        $this->article = $article;

        return $this;
    }

    /**
     * Get article
     *
     * @return \SiteSupervisionBundle\Entity\Article
     */
    public function getArticle()
    {
        return $this->article;
    }
}
