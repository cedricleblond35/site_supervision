<?php

namespace SiteSupervisionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Lot
 *
 * @ORM\Table(name="lot")
 * @ORM\Entity(repositoryClass="SiteSupervisionBundle\Repository\LotRepository")
 */
class Lot
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
     * @ORM\Column(name="numero", type="integer", unique=true)
     *
     */
    private $numero;

    /**
     * @var string
     *
     * @Assert\NotBlank(message="Veuillez donner un nom du lot")
     * @ORM\Column(name="libelle", type="string", length=255, unique=true)
     */
    private $libelle;

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    /**
     * @var \SiteSupervisionBundle\Entity\Article
     *
     * @ORM\OneToMany(targetEntity="\SiteSupervisionBundle\Entity\Article", mappedBy="lot")
     *
     */
    private $articles;


    /**
     * @var \SiteSupervisionBundle\Entity\Construction_site
     *
     * @ORM\ManyToMany(targetEntity="\SiteSupervisionBundle\Entity\Construction_site")
     *
     */
    private $construction_sites;


    /**
     * @var \SiteSupervisionBundle\Entity\Company
     *
     * @ORM\ManyToMany(targetEntity="\SiteSupervisionBundle\Entity\Company")
     * @ORM\JoinColumn(nullable=true)
     *
     */
    private $company;

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->articles = new \Doctrine\Common\Collections\ArrayCollection();
        $this->construction_sites = new \Doctrine\Common\Collections\ArrayCollection();
        $this->company = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Lot
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
     * @return Lot
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
     * Add article
     *
     * @param \SiteSupervisionBundle\Entity\Article $article
     *
     * @return Lot
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

    /**
     * Add constructionSite
     *
     * @param \SiteSupervisionBundle\Entity\Construction_site $constructionSite
     *
     * @return Lot
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

    /**
     * @return Company
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * @param Company $company
     */
    public function setCompany($company)
    {
        $this->company = $company;
    }

    public function __toString()
    {
        return $this->getLibelle();
    }


}
