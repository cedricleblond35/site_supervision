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

    public function create(\SiteSupervisionBundle\Entity\User $user)
    {


        //instancier un utilisateur
        $password = "";

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


//        switch ($user->getRoles())
//        {
//            case "ROLE_ADMIN":
//            case "ROLE_SUPERADMIN":
//                $user->setCustomer(null);
//                $user->setCompagny(null);
//                break;
//
//            case "ROLE_USER_COMPANY_PRINCIPAL":
//            case "ROLE_USER_COMPANY":
//                $user->setCustomer(null);
//                $user->setCompagny($compagny);
//                break;
//
//            case "ROLE_CUSTOMER":
//                $customer = new Customer();
//                $user->setCustomer($customer);
//                $user->setCompagny(null);
//                break;
//
//        }


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