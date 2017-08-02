<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Time;
use AppBundle\Entity\Verb;
use AppBundle\Entity\VerbConjugation;
use AppBundle\Entity\VerbTranslation;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Verb controller.
 *
 * @Route("verb")
 */
class VerbController extends Controller
{
    /**
     * Lists all verb entities.
     *
     * @Route("/", name="verb_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $verbs = $em->getRepository('AppBundle:Verb')->findAll();

        return $this->render('verb/index.html.twig', array(
            'verbs' => $verbs,
        ));
    }

    /**
     * Creates a new verb entity.
     *
     * @Route("/new", name="verb_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $verb = new Verb();

        // -- get conjugation times
        $em = $this->getDoctrine()->getManager();

        $times = $em->getRepository('AppBundle:Time')->findAll();

        // -- add a verbConjugation per time
        foreach ($times as $time) {

            $verbConjugation = new VerbConjugation();

            $verbConjugation->setTime($time);

            $verb->getConjugations()->add($verbConjugation);
        }

        // -- create and add first translation
        $verbTranslation = new verbTranslation();

        $verb->addTranslation($verbTranslation);


        // -- create form
        $form = $this->createForm('AppBundle\Form\VerbType', $verb);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $verbConjugations = $verb->getConjugations();

            foreach ($verbConjugations as $verbConjugation) {
                $verbConjugation->setVerb($verb);
            }

            $em->persist($verb);
            $em->flush();

            return $this->redirectToRoute('verb_show', array('id' => $verb->getId()));
        }

        return $this->render('verb/new.html.twig', array(
            'verb' => $verb,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a verb entity.
     *
     * @Route("/{id}", name="verb_show")
     * @Method("GET")
     */
    public function showAction(Verb $verb)
    {
        $deleteForm = $this->createDeleteForm($verb);

        return $this->render('verb/show.html.twig', array(
            'verb' => $verb,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing verb entity.
     *
     * @Route("/{id}/edit", name="verb_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Verb $verb)
    {
        $deleteForm = $this->createDeleteForm($verb);
        $editForm = $this->createForm('AppBundle\Form\VerbType', $verb);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('verb_edit', array('id' => $verb->getId()));
        }

        return $this->render('verb/edit.html.twig', array(
            'verb' => $verb,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a verb entity.
     *
     * @Route("/{id}", name="verb_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Verb $verb)
    {
        $form = $this->createDeleteForm($verb);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($verb);
            $em->flush();
        }

        return $this->redirectToRoute('verb_index');
    }

    /**
     * Creates a form to delete a verb entity.
     *
     * @param Verb $verb The verb entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Verb $verb)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('verb_delete', array('id' => $verb->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
