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
use Psr\Log\LoggerInterface;

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

    /**
     * Create customer persistence
     * @param \SiteSupervisionBundle\Entity\Customer $customer
     * @return bool : result of changes
     */
    public function create(\SiteSupervisionBundle\Entity\Customer $customer){
        $logger = $this->container->get('logger');
        $result = false;
        //prepare of user
        $userService = $this->container->get('Capvisu.ManagerUser');
        $user = $userService->prepare($customer->getUser());
        
        $customer->setUser($user);
        
        $this->em->persist($customer);
        $this->em->beginTransaction();
        try
        {
            $this->em->flush();
            $this->em->commit();
            $result = true;
        }catch (\ErrorException $error){
            $this->em->rollback();
            $logger->error('Erreur de création d\'un client : ' . $error);
        }
        return $result;
    }

    /**
     * Change customer persistence
     * @param \SiteSupervisionBundle\Entity\Customer $customer
     * @return bool : result of changes
     */
    public function update(\SiteSupervisionBundle\Entity\Customer $customer)
    {
        $logger = $this->container->get('logger');
        $result = false;

        //prepare of user
        //$userService = $this->container->get('Capvisu.ManagerUser');
        //$user = $userService->prepare($customer->getUser());

        //$customer->setUser($user);


        $this->em->persist($customer);

        $this->em->beginTransaction();
        try
        {
            $this->em->flush();
            $this->em->commit();
            $result = true;
        }catch (\ErrorException $error){
            $this->em->rollback();
            $logger->error('Erreur de création d\'un client : ' . $error);
        }
        return $result;

        
    }

    /**
     *
     * test if two objects are equal in security and re-authentication context
     * https://stackoverflow.com/questions/13798662/when-are-user-roles-refreshed-and-how-to-force-it
     * @param \SiteSupervisionBundle\Entity\Customer $user
     * @return bool
     */
    /*public function isEqualTo(\SiteSupervisionBundle\Entity\Customer  $user) {

        if ($user instanceof \SiteSupervisionBundle\Entity\Customer) {
            // Check that the roles are the same, in any order
            $isEqual = count($this->getRoles()) == count($user->getRoles());
            if ($isEqual) {
                foreach($this->getRoles() as $role) {
                    $isEqual = $isEqual && in_array($role, $user->getRoles());
                }
            }
            return $isEqual;
        }

        return false;
    }*/

}