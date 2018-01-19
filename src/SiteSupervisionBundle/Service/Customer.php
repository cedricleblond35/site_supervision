<?php
/**
 * Created by PhpStorm.
 * User: cedricleblond
 * Date: 19/01/18
 * Time: 14:26
 */

namespace SiteSupervisionBundle\Service;


use Doctrine\ORM\EntityManager;
use SiteSupervisionBundle\Entity\User;
use Symfony\Component\DependencyInjection\ContainerInterface;

class Customer
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

    public function create(\SiteSupervisionBundle\Entity\Customer $customer){
        //prepare of user
        $userService = $this->container->get('Capvisu.ManagerUser');
        $user = $userService->prepare($customer->getUser());
        
        $customer->setUser($user);
        
        $this->em->persist($customer);
        $this->em->beginTransaction();
        try{
            $this->em->flush();
            $this->em->commit();
        }catch (\ErrorException $error){
            $this->em->rollback();
            throw $error;
        }
    }
}