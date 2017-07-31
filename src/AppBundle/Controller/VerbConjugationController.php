<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Time;
use AppBundle\Entity\VerbConjugation;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Verbconjugation controller.
 *
 * @Route("verbconjugation")
 */
class VerbConjugationController extends Controller
{
    /**
     * Lists all verbConjugation entities.
     *
     * @Route("/", name="verbconjugation_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $verbConjugations = $em->getRepository('AppBundle:VerbConjugation')->findAll();

        return $this->render('verbconjugation/index.html.twig', array(
            'verbConjugations' => $verbConjugations,
        ));
    }

    /**
     * Creates a new verbConjugation entity.
     *
     * @Route("/new", name="verbconjugation_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $verbConjugation = new Verbconjugation();

        $em = $this->getDoctrine()->getManager();

        $time = $em->getRepository('AppBundle:Time')->findOneby(array('id' => 1));

        $verbConjugation->setTime($time);

        $form = $this->createForm('AppBundle\Form\VerbConjugationType', $verbConjugation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($verbConjugation);
            $em->flush();

            return $this->redirectToRoute('verbconjugation_show', array('id' => $verbConjugation->getId()));
        }

        return $this->render('verbconjugation/new.html.twig', array(
            'verbConjugation' => $verbConjugation,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a verbConjugation entity.
     *
     * @Route("/{id}", name="verbconjugation_show")
     * @Method("GET")
     */
    public function showAction(VerbConjugation $verbConjugation)
    {
        $deleteForm = $this->createDeleteForm($verbConjugation);

        return $this->render('verbconjugation/show.html.twig', array(
            'verbConjugation' => $verbConjugation,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing verbConjugation entity.
     *
     * @Route("/{id}/edit", name="verbconjugation_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, VerbConjugation $verbConjugation)
    {
        $deleteForm = $this->createDeleteForm($verbConjugation);
        $editForm = $this->createForm('AppBundle\Form\VerbConjugationType', $verbConjugation);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('verbconjugation_edit', array('id' => $verbConjugation->getId()));
        }

        return $this->render('verbconjugation/edit.html.twig', array(
            'verbConjugation' => $verbConjugation,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a verbConjugation entity.
     *
     * @Route("/{id}", name="verbconjugation_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, VerbConjugation $verbConjugation)
    {
        $form = $this->createDeleteForm($verbConjugation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($verbConjugation);
            $em->flush();
        }

        return $this->redirectToRoute('verbconjugation_index');
    }

    /**
     * Creates a form to delete a verbConjugation entity.
     *
     * @param VerbConjugation $verbConjugation The verbConjugation entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(VerbConjugation $verbConjugation)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('verbconjugation_delete', array('id' => $verbConjugation->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
