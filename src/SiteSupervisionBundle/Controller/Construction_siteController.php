<?php

namespace SiteSupervisionBundle\Controller;

use SiteSupervisionBundle\Entity\Construction_site;
use SiteSupervisionBundle\Entity\Customer;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Construction_site controller.
 *
 */
class Construction_siteController extends Controller
{
    /**
     * Lists all construction_site entities.
     *
     * @Route("construction_site/", name="construction_site_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $construction_sites = $em->getRepository('SiteSupervisionBundle:Construction_site')->findAll();

        return $this->render('construction_site/index.html.twig', array(
            'construction_sites' => $construction_sites,
        ));
    }

    /**
     * Creates a new construction_site entity.
     *
     * @Route("construction_site/new/{id}/customer", requirements={"id" = "\d+"}, name="construction_site_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request, $id)
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

        $em = $this->getDoctrine()->getManager();

        $construction_site = new Construction_site();

        $customer = $em->getRepository('SiteSupervisionBundle:Customer')->findById($id);

        $form = $this->createForm('SiteSupervisionBundle\Form\Construction_siteType', $construction_site);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            dump($customer);
            dump($form);
            die();
            $em = $this->getDoctrine()->getManager();
            $em->persist($construction_site);
            $em->flush();

            return $this->redirectToRoute('construction_site_show', array('id' => $construction_site->getId()));
        }

        return $this->render('construction_site/new.html.twig', array(
            'construction_site' => $construction_site,
            'customer' => $customer,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a construction_site entity.
     *
     * @Route("construction_site/{id}", name="construction_site_show")
     * @Method("GET")
     */
    public function showAction(Construction_site $construction_site)
    {
        $deleteForm = $this->createDeleteForm($construction_site);

        return $this->render('construction_site/show.html.twig', array(
            'construction_site' => $construction_site,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing construction_site entity.
     *
     * @Route("construction_site/{id}/edit", name="construction_site_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Construction_site $construction_site)
    {
        $deleteForm = $this->createDeleteForm($construction_site);
        $editForm = $this->createForm('SiteSupervisionBundle\Form\Construction_siteType', $construction_site);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('construction_site_edit', array('id' => $construction_site->getId()));
        }

        return $this->render('construction_site/edit.html.twig', array(
            'construction_site' => $construction_site,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a construction_site entity.
     *
     * @Route("construction_site/{id}", name="construction_site_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Construction_site $construction_site)
    {
        $form = $this->createDeleteForm($construction_site);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($construction_site);
            $em->flush();
        }

        return $this->redirectToRoute('construction_site_index');
    }

    /**
     * Creates a form to delete a construction_site entity.
     *
     * @param Construction_site $construction_site The construction_site entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Construction_site $construction_site)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('construction_site_delete', array('id' => $construction_site->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
