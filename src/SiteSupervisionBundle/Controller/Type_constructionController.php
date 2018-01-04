<?php

namespace SiteSupervisionBundle\Controller;

use SiteSupervisionBundle\Entity\Type_construction;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Type_construction controller.
 *
 * @Route("type_construction")
 */
class Type_constructionController extends Controller
{
    /**
     * Lists all type_construction entities.
     *
     * @Route("/", name="type_construction_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $type_constructions = $em->getRepository('SiteSupervisionBundle:Type_construction')->findAll();

        return $this->render('type_construction/index.html.twig', array(
            'type_constructions' => $type_constructions,
        ));
    }

    /**
     * Creates a new type_construction entity.
     *
     * @Route("/new", name="type_construction_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $type_construction = new Type_construction();
        $form = $this->createForm('SiteSupervisionBundle\Form\Type_constructionType', $type_construction);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($type_construction);
            $em->flush();

            return $this->redirectToRoute('type_construction_show', array('id' => $type_construction->getId()));
        }

        return $this->render('type_construction/new.html.twig', array(
            'type_construction' => $type_construction,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a type_construction entity.
     *
     * @Route("/{id}", name="type_construction_show")
     * @Method("GET")
     */
    public function showAction(Type_construction $type_construction)
    {
        $deleteForm = $this->createDeleteForm($type_construction);

        return $this->render('type_construction/show.html.twig', array(
            'type_construction' => $type_construction,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing type_construction entity.
     *
     * @Route("/{id}/edit", name="type_construction_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Type_construction $type_construction)
    {
        $deleteForm = $this->createDeleteForm($type_construction);
        $editForm = $this->createForm('SiteSupervisionBundle\Form\Type_constructionType', $type_construction);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('type_construction_edit', array('id' => $type_construction->getId()));
        }

        return $this->render('type_construction/edit.html.twig', array(
            'type_construction' => $type_construction,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a type_construction entity.
     *
     * @Route("/{id}", name="type_construction_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Type_construction $type_construction)
    {
        $form = $this->createDeleteForm($type_construction);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($type_construction);
            $em->flush();
        }

        return $this->redirectToRoute('type_construction_index');
    }

    /**
     * Creates a form to delete a type_construction entity.
     *
     * @param Type_construction $type_construction The type_construction entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Type_construction $type_construction)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('type_construction_delete', array('id' => $type_construction->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
