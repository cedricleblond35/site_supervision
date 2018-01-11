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

    public function create(\SiteSupervisionBundle\Entity\User $userForm)
    {
        //instancier un utilisateur
        $user = new \SiteSupervisionBundle\Entity\User();
        $password = "";

        if($userForm->getPassword() != "")
        {
            $password = $this->container->get('security.password_encoder')->encodePassword($userForm, $userForm->getPassword());
        }

        $user->setEmail($userForm->getEmail());
        $user->setPassword($password);
        $user->setLastConnection(new \DateTime());
        $user->setIsActive(true);
        $user->setToken('');
        $user->setConnectionFailure('0');
        $user->setRoles($userForm->getRoles());
        $user->setCustomer(null);
        $user->setCompagny(null);

        

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
}