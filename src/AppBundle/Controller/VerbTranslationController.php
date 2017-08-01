<?php

namespace AppBundle\Controller;

use AppBundle\Entity\VerbTranslation;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Verbtranslation controller.
 *
 * @Route("verbtranslation")
 */
class VerbTranslationController extends Controller
{
    /**
     * Lists all verbTranslation entities.
     *
     * @Route("/", name="verbtranslation_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $verbTranslations = $em->getRepository('AppBundle:VerbTranslation')->findAll();

        return $this->render('verbtranslation/index.html.twig', array(
            'verbTranslations' => $verbTranslations,
        ));
    }

    /**
     * Creates a new verbTranslation entity.
     *
     * @Route("/new", name="verbtranslation_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $verbTranslation = new Verbtranslation();
        $form = $this->createForm('AppBundle\Form\VerbTranslationType', $verbTranslation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($verbTranslation);
            $em->flush();

            return $this->redirectToRoute('verbtranslation_show', array('id' => $verbTranslation->getId()));
        }

        return $this->render('verbtranslation/new.html.twig', array(
            'verbTranslation' => $verbTranslation,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a verbTranslation entity.
     *
     * @Route("/{id}", name="verbtranslation_show")
     * @Method("GET")
     */
    public function showAction(VerbTranslation $verbTranslation)
    {
        $deleteForm = $this->createDeleteForm($verbTranslation);

        return $this->render('verbtranslation/show.html.twig', array(
            'verbTranslation' => $verbTranslation,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing verbTranslation entity.
     *
     * @Route("/{id}/edit", name="verbtranslation_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, VerbTranslation $verbTranslation)
    {
        $deleteForm = $this->createDeleteForm($verbTranslation);
        $editForm = $this->createForm('AppBundle\Form\VerbTranslationType', $verbTranslation);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('verbtranslation_edit', array('id' => $verbTranslation->getId()));
        }

        return $this->render('verbtranslation/edit.html.twig', array(
            'verbTranslation' => $verbTranslation,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a verbTranslation entity.
     *
     * @Route("/{id}", name="verbtranslation_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, VerbTranslation $verbTranslation)
    {
        $form = $this->createDeleteForm($verbTranslation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($verbTranslation);
            $em->flush();
        }

        return $this->redirectToRoute('verbtranslation_index');
    }

    /**
     * Creates a form to delete a verbTranslation entity.
     *
     * @param VerbTranslation $verbTranslation The verbTranslation entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(VerbTranslation $verbTranslation)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('verbtranslation_delete', array('id' => $verbTranslation->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
