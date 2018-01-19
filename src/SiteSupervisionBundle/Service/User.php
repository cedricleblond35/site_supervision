<?php
/**
 * Created by PhpStorm.
 * User: cedricleblond
 * Date: 02/01/18
 * Time: 19:31
 *
 * doc : https://symfony.com/doc/3.4/service_container.html
 */

namespace SiteSupervisionBundle\Service;

use Doctrine\ORM\EntityManager;
use SiteSupervisionBundle\Entity\Company;
use SiteSupervisionBundle\Entity\Customer;
use Symfony\Component\DependencyInjection\ContainerInterface;


class User
{
    /**
     * @var EntityManager
     */
    private $em;

    /**
     * @var ContainerInterface
     */
    private $container;



    /**
     * UserService constructor.
     * @param \Doctrine\ORM\EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager, ContainerInterface $container)
    {
        $this->em = $entityManager;
        $this->container = $container;
        
    }

    public function prepare(\SiteSupervisionBundle\Entity\User $user)
    {
        if($user->getPassword() != "")
        {
        $user->setPassword(
            $this->container->get('security.password_encoder')
                ->encodePassword($user, $user->getPassword())
        );
        }

        $user->setLastConnection(new \DateTime());
        $user->setIsActive(true);
        $user->setToken('');
        $user->setConnectionFailure('0');

        return $user;
    }

    public function create(\SiteSupervisionBundle\Entity\User $user)
    {
        $user = $this->prepare($user);

        //persister les données
        $this->em->persist($user);
        $this->em->beginTransaction();
        try{
            $this->em->flush();
            $this->em->commit();
        } catch (\ErrorException $error)
        {
            $this->em->rollback();
            throw $error;
        }
    }

    public function select(\SiteSupervisionBundle\Entity\User $userForm){

    }
}