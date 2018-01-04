<?php

namespace SiteSupervisionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * General_comment
 *
 * @ORM\Table(name="general_comment")
 * @ORM\Entity(repositoryClass="SiteSupervisionBundle\Repository\General_commentRepository")
 */
class General_comment
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
     * @ORM\Column(name="commentaire", type="string", length=255)
     */
    private $commentaire;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var \SiteSupervisionBundle\Entity\Construction_site
     *
     * @ORM\ManyToOne(targetEntity="\SiteSupervisionBundle\Entity\Construction_site", inversedBy="general_comments", cascade={"remove"})
     *
     */
    private $construction_site;



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
     * Set commentaire
     *
     * @param string $commentaire
     *
     * @return General_comment
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
     * Set date
     *
     * @param \DateTime $date
     *
     * @return General_comment
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set constructionSite
     *
     * @param \SiteSupervisionBundle\Entity\Construction_site $constructionSite
     *
     * @return General_comment
     */
    public function setConstructionSite(\SiteSupervisionBundle\Entity\Construction_site $constructionSite = null)
    {
        $this->construction_site = $constructionSite;

        return $this;
    }

    /**
     * Get constructionSite
     *
     * @return \SiteSupervisionBundle\Entity\Construction_site
     */
    public function getConstructionSite()
    {
        return $this->construction_site;
    }
}
