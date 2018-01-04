<?php

namespace SiteSupervisionBundle\Controller;

use SiteSupervisionBundle\Entity\General_comment;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * General_comment controller.
 *
 * @Route("general_comment")
 */
class General_commentController extends Controller
{
    /**
     * Lists all general_comment entities.
     *
     * @Route("/", name="general_comment_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $general_comments = $em->getRepository('SiteSupervisionBundle:General_comment')->findAll();

        return $this->render('general_comment/index.html.twig', array(
            'general_comments' => $general_comments,
        ));
    }

    /**
     * Creates a new general_comment entity.
     *
     * @Route("/new", name="general_comment_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $general_comment = new General_comment();
        $form = $this->createForm('SiteSupervisionBundle\Form\General_commentType', $general_comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($general_comment);
            $em->flush();

            return $this->redirectToRoute('general_comment_show', array('id' => $general_comment->getId()));
        }

        return $this->render('general_comment/new.html.twig', array(
            'general_comment' => $general_comment,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a general_comment entity.
     *
     * @Route("/{id}", name="general_comment_show")
     * @Method("GET")
     */
    public function showAction(General_comment $general_comment)
    {
        $deleteForm = $this->createDeleteForm($general_comment);

        return $this->render('general_comment/show.html.twig', array(
            'general_comment' => $general_comment,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing general_comment entity.
     *
     * @Route("/{id}/edit", name="general_comment_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, General_comment $general_comment)
    {
        $deleteForm = $this->createDeleteForm($general_comment);
        $editForm = $this->createForm('SiteSupervisionBundle\Form\General_commentType', $general_comment);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('general_comment_edit', array('id' => $general_comment->getId()));
        }

        return $this->render('general_comment/edit.html.twig', array(
            'general_comment' => $general_comment,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a general_comment entity.
     *
     * @Route("/{id}", name="general_comment_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, General_comment $general_comment)
    {
        $form = $this->createDeleteForm($general_comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($general_comment);
            $em->flush();
        }

        return $this->redirectToRoute('general_comment_index');
    }

    /**
     * Creates a form to delete a general_comment entity.
     *
     * @param General_comment $general_comment The general_comment entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(General_comment $general_comment)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('general_comment_delete', array('id' => $general_comment->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
