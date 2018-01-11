<?php

namespace SiteSupervisionBundle\Controller;

use SiteSupervisionBundle\Entity\Company;
use SiteSupervisionBundle\Entity\Customer;
use SiteSupervisionBundle\Entity\User;
use SiteSupervisionBundle\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class SecurityController extends Controller
{
    /**
     * @Route("/register", name="user_registration")
     */
    public function registerAction(Request $request)
    {
        // 1) build the form
        $user  = new User();
        $form = $this->createForm(UserType::class, $user);

        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            // 3) Encode the password (you could also do this via Doctrine listener)
            $password = $this->get('security.password_encoder')->encodePassword($user, $user->getPassword());
            $user->setPassword($password);
            $user->setLastConnection(new \DateTime());
            $user->setIsActive(true);
            $user->setToken('');
            $user->setConnectionFailure('0');


            if($user->getRoles() == "ROLE_CUSTOMER")
            {
                $customer = new Customer();
                $user->setCustomer($customer);

            } elseif ($user->getRoles() == "ROLE_USER_COMPANY_PRINCIPAL")
            {
                $compagny = new Company();
                $user->setCompagny($compagny);
            }

            // 4) save the User!
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            //créer le message de succes
            $this->addFlash("success", "Le compte à bien été créé");

            return $this->redirectToRoute('login');

        }
        
        return $this->render('registration/register.html.twig',
            ['form' => $form->createView()]);
    }


    /**
     * @Route("/login", name="login")
     */
    public function loginAction(Request $request)
    {
        $authenticationUtils = $this->get('security.authentication_utils');

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/connection.html.twig', array(
            'last_username' => $lastUsername,
            'error'         => $error,
        ));
    }

}
