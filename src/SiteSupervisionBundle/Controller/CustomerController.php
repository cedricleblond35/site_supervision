<?php

namespace SiteSupervisionBundle\Controller;

use SiteSupervisionBundle\Entity\Customer;
use SiteSupervisionBundle\Entity\User;
use SiteSupervisionBundle\Form\CustomerType;
use SiteSupervisionBundle\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

use SiteSupervisionBundle\Entity\Company;

/**
 * Customer controller.
 *
 * @Route("customer")
 */
class CustomerController extends Controller
{
    /**
     * Lists all customer entities.
     *
     * @Route("/", name="customer_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $customers = $em->getRepository('SiteSupervisionBundle:Customer')->findAll();

        
        return $this->render('customer/index.html.twig', array(
            'customers' => $customers,
        ));
    }

    /**
     * Creates a new customer entity.
     *
     * @Route("/new", name="customer_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {

        //select the city according to the department
        if($request->isXmlHttpRequest()){
            $tmpVille = array();
            $cp = $request->request->get('some_var_name');
            if($cp)
            {
                $data = $this->getDoctrine()->getRepository('SiteSupervisionBundle:VillesFranceFree')->findBy(
                    array('villeCodePostal' => $cp),
                    array('villeNom' => 'ASC')
                );


                //si le retour de doctrine est un tableau (plusieurs villes)
                if (is_array($data))
                {
                    foreach($data as $ville)
                    {
                        $tmpVille[$ville->getId()] = $ville->getVilleNomReel();
                    }
                }
                else
                {
                    $tmpVille[$data->getId()] = $data->getVilleNomReel();
                }

                $arrData = ['output' => $tmpVille];
                return new JsonResponse($arrData);
            }
        }

        // 1) build the form
        // we will create a user client who is a user
        // follow the schema for persistence of data
        $user  = new User();
        $customer = new Customer();
        $user->setCustomer($customer);
        $customer->setUser($user);

        $form = $this->createForm(CustomerType::class, $customer, array(
            'action' => $this->generateUrl('customer_new'),
            'method' => 'POST',
        ));


        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $customerService = $this->container->get('Capvisu.ManagerCustomer');
            $customerService->create($customer);
            
            //créer le message de succes
            $this->addFlash("success", "Le compte à bien été créé");

            return $this->redirectToRoute('customer_index');

        }

        return $this->render('customer/new.html.twig', array(
            //'customer' => $customer,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a customer entity.
     *
     * @Route("/{id}/show", name="customer_show")
     * @Method("GET")
     */
    public function showAction(Customer $customer)
    {
        $deleteForm = $this->createDeleteForm($customer);

        return $this->render('customer/show.html.twig', array(
            'customer' => $customer,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing customer entity.
     *
     * @Route("/{id}/edit", name="customer_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction($id, Request $request, Customer $customer)
    {

        if(is_numeric($id))
        {
            $em = $this->getDoctrine()->getManager();
            $customer = $em->getRepository('SiteSupervisionBundle:Customer')->find($id);
        }


        if(!is_null($customer)) {
            try {
                //formulaire de suppression
                $deleteForm = $this->createDeleteForm($customer);

                //******************************* PROBLEME DE LOGIQUE *************************************
                $editForm = $this->createForm('SiteSupervisionBundle\Form\CustomerType', $customer,
                    array(
                        'action' => $this->generateUrl('customer_edit', array('id' => $customer->getId())))
                );
                $editForm->handleRequest($request);
            }
            catch (Exception $ex)
            {
                $this->addFlash("error", "Le client n'a pas été trouvé");
            }

            //traitement du formulaire
            if ($editForm->isSubmitted() && $editForm->isValid()) {
                $user = $customer->getUser();
                // 3) Encode the password (you could also do this via Doctrine listener)
                dump($customer);
                die();
                $password = $this->get('security.password_encoder')->encodePassword($user, $user->getPassword());
                $user->setPassword($password);
                $user->setLastConnection(new \DateTime());
                $user->setIsActive(true);
                $user->setToken('');
                $user->setConnectionFailure('0');

                if($user->getRoles() == "ROLE_CUSTOMER")
                {
                    $user->setCustomer($customer);

                } elseif ($user->getRoles() == "ROLE_USER_COMPANY_PRINCIPAL")
                {
                    $company = new Company();
                    $user->setCompany($company);
                }

                // 4) save the User!
                $this->getDoctrine()->getManager()->flush();

                //créer le message de succes
                $this->addFlash("success", "Le compte à bien été créé");

                return $this->redirectToRoute('customer_edit', array('id' => $customer->getId()));
            }

            return $this->render('customer/edit.html.twig', array(
                'form' => $editForm->createView(),
                'delete_form' => $deleteForm->createView(),
            ));
        }
        else
        {
            $this->addFlash("error", "L'identifiant n'est pas correct (error 2)");
        }
    }

    /**
     * Deletes a customer entity.
     *
     * @Route("/{id}/delete", requirements={"id" = "\d+"}, name="customer_delete")
     * @Method({"GET", "DELETE"})
     */
    public function deleteAction($id)
    {
        if(is_numeric($id)){
            $id = intval($id);
            try{
                $repository = $this->getDoctrine()->getRepository('SiteSupervisionBundle:Customer');
                $customer = $repository->find($id);

                $em = $this->getDoctrine()->getManager();
                $em->remove($customer);
                $em->flush();

                $this->addFlash("success", "Le client ".$customer->getNom()." a bien été supprimer");
            }
            catch (Exception $ex)
            {
                $this->addFlash("error", "Le client n'a pas été supprimer");
            }
        }
         else
         {
             $this->addFlash("error", "L'identifiant n'est pas correct (error 2)");
         }

        // Retrieve flashbag from the controller
        //$flashbag = $this->get('session')->getFlashBag();
        
        return $this->redirectToRoute('customer_index');

    }

   
    /**
     * Deletes a customer entity.
     *
     * @Route("/{id}", name="deleteActionbeta")
     * @Method("DELETE")
     */
    public function deleteActionbeta(Request $request, Customer $customer)
    {
        $form = $this->createDeleteForm($customer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($customer);
            $em->flush();
        }

        return $this->redirectToRoute('customer_index');
    }

    /**
     * Creates a form to delete a customer entity.
     *
     * @param Customer $customer The customer entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Customer $customer)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('customer_delete', array('id' => $customer->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
