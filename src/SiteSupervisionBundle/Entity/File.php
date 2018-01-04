<?php
/**
 * Created by PhpStorm.
 * User: cedricleblond
 * Date: 08/10/17
 * Time: 18:22
 */

namespace SiteSupervisionBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Image
 *
 * @ORM\Table(name="image")
 * @ORM\Entity(repositoryClass="FarmBundle\Repository\ImageRepository")
 */
class File
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
     * @ORM\Column(name="Filename", type="string", length=255, unique=true)
     */
    private $filename;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var \SiteSupervisionBundle\Entity\Product
     *
     * @ORM\ManyToOne(targetEntity="\SiteSupervisionBundle\Entity\Product", inversedBy="attached_files")
     */
    private $product;

    /**
     * @var \SiteSupervisionBundle\Entity\Article
     *
     * @ORM\ManyToOne(targetEntity="\SiteSupervisionBundle\Entity\Article", inversedBy="attached_files")
     */
    private $article;

    /**
     * @var \SiteSupervisionBundle\Entity\Construction_site
     *
     * @ORM\ManyToOne(targetEntity="\SiteSupervisionBundle\Entity\Construction_site", inversedBy="attached_files")
     */
    private $contruction_site;


    /**
     * Cette propriete sert à afficher un input file dans le form
     * elle n'est pas sauvegardée en bdd, car il n'y a pas d'annotation Column
     *
     * @var UploadedFile
     *
     * @Assert\Image(
     *     minWidth = 200,
     *     maxWidth = 5000,
     *     minHeight = 200,
     *     maxHeight = 5000,
     *     maxSize = "20M",
     *     maxSizeMessage = "votre fichier est trop lourd",
     *     )
     *
     */
    private $file;


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
     * Set filename
     *
     * @param string $filename
     *
     * @return File
     */
    public function setFilename($filename)
    {
        $this->filename = $filename;

        return $this;
    }

    /**
     * Get filename
     *
     * @return string
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return File
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set product
     *
     * @param \SiteSupervisionBundle\Entity\Product $product
     *
     * @return File
     */
    public function setProduct(\SiteSupervisionBundle\Entity\Product $product = null)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     *
     * @return \SiteSupervisionBundle\Entity\Product
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * Set article
     *
     * @param \SiteSupervisionBundle\Entity\Article $article
     *
     * @return File
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
     * Set contructionSite
     *
     * @param \SiteSupervisionBundle\Entity\Construction_site $contructionSite
     *
     * @return File
     */
    public function setContructionSite(\SiteSupervisionBundle\Entity\Construction_site $contructionSite = null)
    {
        $this->contruction_site = $contructionSite;

        return $this;
    }

    /**
     * Get contructionSite
     *
     * @return \SiteSupervisionBundle\Entity\Construction_site
     */
    public function getContructionSite()
    {
        return $this->contruction_site;
    }
}
