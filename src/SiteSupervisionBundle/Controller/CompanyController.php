<?php

namespace SiteSupervisionBundle\Controller;

use SiteSupervisionBundle\Entity\Company;
use SiteSupervisionBundle\Entity\Employee;
use SiteSupervisionBundle\Entity\User;
use SiteSupervisionBundle\Form\CompanyType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Company controller.
 *
 * @Route("company")
 */
class CompanyController extends Controller
{
    /**
     * Lists all company entities.
     *
     * @Route("/", name="company_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $companies = $em->getRepository('SiteSupervisionBundle:Company')->findAll();

        return $this->render('company/index.html.twig', array(
            'companies' => $companies,
        ));
    }

    /**
     * Creates a new company entity.
     *
     * @Route("/new", name="company_new")
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
        $user = new User();
        $company = new Company();
        $employee = new Employee();
        
        $user->setEmployee($employee);
        $employee->setUser($user);
        
        $company->addEmployee($employee);
        $employee[0]->setCompany($company);
        
        $form = $this->createForm(CompanyType::class, $company, array(
            'action' => $this->generateUrl('company_new'),
            'method' => 'POST',
        ));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //$companyService = $this->container->get('Capvisu.ManagerCompany');
            //$companyService->create($company);

            $employee = $company->getEmployees();

            //prepare of user
            $userService = $this->container->get('Capvisu.ManagerUser');
            $user = $userService->prepare($employee[0]->getUser());

            $company->getEmployees()[0]->setUser($user);

            $em = $this->getDoctrine()->getManager();

            //$em->persist($user);
            //dump($user);
            //$em->persist($employee);
            $em->persist($company);
            dump($company);
            $em->flush();

            return $this->redirectToRoute('company_show', array('id' => $company->getId()));
        }

        return $this->render('company/new.html.twig', array(
            //'company' => $company,
            //'employee' => $employee,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a company entity.
     *
     * @Route("/{id}", name="company_show")
     * @Method("GET")
     */
    public function showAction(Company $company)
    {
        $deleteForm = $this->createDeleteForm($company);

        return $this->render('company/show.html.twig', array(
            'company' => $company,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing company entity.
     *
     * @Route("/{id}/edit", name="company_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Company $company)
    {
        $deleteForm = $this->createDeleteForm($company);
        $editForm = $this->createForm('SiteSupervisionBundle\Form\CompanyType', $company);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('company_edit', array('id' => $company->getId()));
        }

        return $this->render('company/edit.html.twig', array(
            'company' => $company,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a company entity.
     *
     * @Route("/{id}", name="company_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Company $company)
    {
        $form = $this->createDeleteForm($company);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($company);
            $em->flush();
        }

        return $this->redirectToRoute('company_index');
    }

    /**
     * Creates a form to delete a company entity.
     *
     * @param Company $company The company entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Company $company)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('company_delete', array('id' => $company->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
