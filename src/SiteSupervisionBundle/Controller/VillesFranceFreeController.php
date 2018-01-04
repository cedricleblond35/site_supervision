<?php

namespace SiteSupervisionBundle\Controller;

use SiteSupervisionBundle\Entity\VillesFranceFree;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Villesfrancefree controller.
 *
 * @Route("city")
 */
class VillesFranceFreeController extends Controller
{
    /**
     * Lists all villesFranceFree entities.
     *
     * @Route("/", name="city_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $villesFranceFrees = $em->getRepository('SiteSupervisionBundle:VillesFranceFree')->findAll();

        return $this->render('villesfrancefree/index.html.twig', array(
            'villesFranceFrees' => $villesFranceFrees,
        ));
    }

    /**
     * Creates a new villesFranceFree entity.
     *
     * @Route("/new", name="city_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $villesFranceFree = new Villesfrancefree();
        $form = $this->createForm('SiteSupervisionBundle\Form\VillesFranceFreeType', $villesFranceFree);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($villesFranceFree);
            $em->flush();

            return $this->redirectToRoute('city_show', array('id' => $villesFranceFree->getId()));
        }

        return $this->render('villesfrancefree/new.html.twig', array(
            'villesFranceFree' => $villesFranceFree,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a villesFranceFree entity.
     *
     * @Route("/{id}", name="city_show")
     * @Method("GET")
     */
    public function showAction(VillesFranceFree $villesFranceFree)
    {
        $deleteForm = $this->createDeleteForm($villesFranceFree);

        return $this->render('villesfrancefree/show.html.twig', array(
            'villesFranceFree' => $villesFranceFree,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing villesFranceFree entity.
     *
     * @Route("/{id}/edit", name="city_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, VillesFranceFree $villesFranceFree)
    {
        $deleteForm = $this->createDeleteForm($villesFranceFree);
        $editForm = $this->createForm('SiteSupervisionBundle\Form\VillesFranceFreeType', $villesFranceFree);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('city_edit', array('id' => $villesFranceFree->getId()));
        }

        return $this->render('villesfrancefree/edit.html.twig', array(
            'villesFranceFree' => $villesFranceFree,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a villesFranceFree entity.
     *
     * @Route("/{id}", name="city_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, VillesFranceFree $villesFranceFree)
    {
        $form = $this->createDeleteForm($villesFranceFree);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($villesFranceFree);
            $em->flush();
        }

        return $this->redirectToRoute('city_index');
    }

    /**
     * Creates a form to delete a villesFranceFree entity.
     *
     * @param VillesFranceFree $villesFranceFree The villesFranceFree entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(VillesFranceFree $villesFranceFree)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('city_delete', array('id' => $villesFranceFree->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
