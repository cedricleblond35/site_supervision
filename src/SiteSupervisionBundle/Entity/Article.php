<?php

namespace SiteSupervisionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Article
 *
 * @ORM\Table(name="article")
 * @ORM\Entity(repositoryClass="SiteSupervisionBundle\Repository\ArticleRepository")
 */
class Article
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
     * @var int : position de l'article
     *
     * @ORM\Column(name="numero", type="integer")
     *
     */
    private $numero;

    /**
     * @var string
     * @Assert\NotBlank(message="Veuillez donner le libellé de l'article")
     *
     * @ORM\Column(name="libelle", type="string", length=255)
     */
    private $libelle;

    /**
     * @var text
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="localisation", type="string", length=255)
     */
    private $localisation;

    //////////////////////////////////////////////////----------------------------------------------------------
    /**
     * @var \SiteSupervisionBundle\Entity\File
     * @ORM\OneToMany(targetEntity="\SiteSupervisionBundle\Entity\File", mappedBy="article")
     *
     */
    private $attached_files;
    
    
    /**
     * @var \SiteSupervisionBundle\Entity\Lot
     *
     * @ORM\ManyToOne(targetEntity="\SiteSupervisionBundle\Entity\Lot", inversedBy="articles")
     *
     */
    private $lot;

    /**
     * @var \SiteSupervisionBundle\Entity\Product
     *
     * @ORM\OneToMany(targetEntity="\SiteSupervisionBundle\Entity\Product", mappedBy="article")
     *
     */
    private $products;

    /**
     * @var \SiteSupervisionBundle\Entity\Article
     *
     * @ORM\ManyToOne(targetEntity="\SiteSupervisionBundle\Entity\Article", inversedBy="articles")
     *
     */
    private $article;

    /**
     * @var \SiteSupervisionBundle\Entity\Article
     *
     * @ORM\OneToMany(targetEntity="\SiteSupervisionBundle\Entity\Article", mappedBy="article")
     *
     */
    private $articles;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->attached_files = new \Doctrine\Common\Collections\ArrayCollection();
        $this->products = new \Doctrine\Common\Collections\ArrayCollection();
        $this->articles = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set numero
     *
     * @param integer $numero
     *
     * @return Article
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get numero
     *
     * @return integer
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Set libelle
     *
     * @param string $libelle
     *
     * @return Article
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * Get libelle
     *
     * @return string
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Article
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
     * Set localisation
     *
     * @param string $localisation
     *
     * @return Article
     */
    public function setLocalisation($localisation)
    {
        $this->localisation = $localisation;

        return $this;
    }

    /**
     * Get localisation
     *
     * @return string
     */
    public function getLocalisation()
    {
        return $this->localisation;
    }

    /**
     * Add attachedFile
     *
     * @param \SiteSupervisionBundle\Entity\File $attachedFile
     *
     * @return Article
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
     * Set lot
     *
     * @param \SiteSupervisionBundle\Entity\Lot $lot
     *
     * @return Article
     */
    public function setLot(\SiteSupervisionBundle\Entity\Lot $lot = null)
    {
        $this->lot = $lot;

        return $this;
    }

    /**
     * Get lot
     *
     * @return \SiteSupervisionBundle\Entity\Lot
     */
    public function getLot()
    {
        return $this->lot;
    }

    /**
     * Add product
     *
     * @param \SiteSupervisionBundle\Entity\Product $product
     *
     * @return Article
     */
    public function addProduct(\SiteSupervisionBundle\Entity\Product $product)
    {
        $this->products[] = $product;

        return $this;
    }

    /**
     * Remove product
     *
     * @param \SiteSupervisionBundle\Entity\Product $product
     */
    public function removeProduct(\SiteSupervisionBundle\Entity\Product $product)
    {
        $this->products->removeElement($product);
    }

    /**
     * Get products
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * Set article
     *
     * @param \SiteSupervisionBundle\Entity\Article $article
     *
     * @return Article
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

    /**
     * Add article
     *
     * @param \SiteSupervisionBundle\Entity\Article $article
     *
     * @return Article
     */
    public function addArticle(\SiteSupervisionBundle\Entity\Article $article)
    {
        $this->articles[] = $article;

        return $this;
    }

    /**
     * Remove article
     *
     * @param \SiteSupervisionBundle\Entity\Article $article
     */
    public function removeArticle(\SiteSupervisionBundle\Entity\Article $article)
    {
        $this->articles->removeElement($article);
    }

    /**
     * Get articles
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getArticles()
    {
        return $this->articles;
    }
}
