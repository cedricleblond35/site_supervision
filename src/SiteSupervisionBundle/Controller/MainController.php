<?php

namespace SiteSupervisionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class MainController extends Controller
{
    /**
     * 
     * @Route("/", name="main")
     */
    public function indexAction($name)
    {
        $user = $this->getUser();
        $role = $this->container->get('security.role_hierarchy');

        //dump($role);
        if(in_array("ROLE_SUPER_ADMIN", $user->getRoles())){
            //return $this->redirectToRoute('customer_index');
        }


        return $this->render('base.html.twig', array('name' => $name));
    }
}
