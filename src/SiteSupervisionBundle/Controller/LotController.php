<?php

namespace SiteSupervisionBundle\Controller;

use SiteSupervisionBundle\Entity\Lot;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Lot controller.
 *
 * @Route("lot")
 */
class LotController extends Controller
{
    /**
     * Lists all lot entities.
     *
     * @Route("/", name="lot_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $lots = $em->getRepository('SiteSupervisionBundle:Lot')->findAll();

        return $this->render('lot/index.html.twig', array(
            'lots' => $lots,
        ));
    }

    /**
     * Creates a new lot entity.
     *
     * @Route("/new", name="lot_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $lot = new Lot();
        $form = $this->createForm('SiteSupervisionBundle\Form\LotType', $lot);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($lot);
            $em->flush();

            return $this->redirectToRoute('lot_show', array('id' => $lot->getId()));
        }

        return $this->render('lot/new.html.twig', array(
            'lot' => $lot,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a lot entity.
     *
     * @Route("/{id}", name="lot_show")
     * @Method("GET")
     */
    public function showAction(Lot $lot)
    {
        $deleteForm = $this->createDeleteForm($lot);

        return $this->render('lot/show.html.twig', array(
            'lot' => $lot,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing lot entity.
     *
     * @Route("/{id}/edit", name="lot_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Lot $lot)
    {
        $deleteForm = $this->createDeleteForm($lot);
        $editForm = $this->createForm('SiteSupervisionBundle\Form\LotType', $lot);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('lot_edit', array('id' => $lot->getId()));
        }

        return $this->render('lot/edit.html.twig', array(
            'lot' => $lot,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a lot entity.
     *
     * @Route("/{id}", name="lot_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Lot $lot)
    {
        $form = $this->createDeleteForm($lot);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($lot);
            $em->flush();
        }

        return $this->redirectToRoute('lot_index');
    }

    /**
     * Creates a form to delete a lot entity.
     *
     * @param Lot $lot The lot entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Lot $lot)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('lot_delete', array('id' => $lot->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
