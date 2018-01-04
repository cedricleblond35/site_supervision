<?php
/**
 * Created by PhpStorm.
 * User: cedricleblond
 * Date: 02/01/18
 * Time: 19:31
 */

namespace SiteSupervisionBundle\Service;



class User
{
    protected $em;

    /**
     * UserService constructor.
     * @param \Doctrine\ORM\EntityManager $entityManager
     */
    public function __construct(\Doctrine\ORM\EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }

    public function add(User $userForm)
    {


        //instancier un utilisateur
        $user = new User();
        $password = "";

        if($userForm->getPassword() != "")
        {
            $password = $this->get('security.password_encoder')->encodePassword($userForm, $userForm->getPassword());
        }

        $user->setPassword($password);
        $user->setLastConnection(new \DateTime());
        $user->setIsActive(true);
        $user->setToken('');
        $user->setConnectionFailure('0');
        $user->setRoles($userForm->getRoles());

        //Définir le type d'utilisateur
        if($userForm->getRoles() == "ROLE_CUSTOMER")
        {
            $user->setCustomer(new Customer());
        } else
        {
            $user->setCompagny(new Company());
        }

        //persister les données
        try{
            $this->em->persist($user);
            $this->em->flush();
            $this->em->commit();
        } catch (\ErrorException $error)
        {
            $this->em->rollback();
        }

    }
}