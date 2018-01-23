<?php
/**
 * Created by PhpStorm.
 * User: cedricleblond
 * Date: 23/01/18
 * Time: 09:17
 */

namespace SiteSupervisionBundle\Service;


use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\ContainerInterface;

class Company
{
    /**
     * @var EntityManager
     */
    private $em;

    /**
     * @var ContainerInterface
     */
    private $container;

    public function __construct(EntityManager $entityManager, ContainerInterface $container)
    {
        $this->container = $container;
        $this->em = $entityManager;
    }

    public function create(\SiteSupervisionBundle\Entity\Company $company){
        
        

    }

}