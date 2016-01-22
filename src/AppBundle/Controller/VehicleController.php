<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Vehicle;
use AppBundle\Form\VehicleType;

/**
 * Vehicle controller.
 *
 * @Route("/")
 */
class VehicleController extends Controller
{
    /**
     * Lists all Vehicle entities.
     *
     * @Route("/", name="_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $vehicles = $em->getRepository('AppBundle:Vehicle')->findAll();

        return $this->render('vehicle/index.html.twig', array(
            'vehicles' => $vehicles,
        ));
    }

    /**
     * Creates a new Vehicle entity.
     *
     * @Route("/samochod/nowy", name="_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $vehicle = new Vehicle();
        $form = $this->createForm('AppBundle\Form\VehicleType', $vehicle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($vehicle);
            $em->flush();

            return $this->redirectToRoute('_show', array('id' => $vehicle->getId()));
        }

        return $this->render('vehicle/new.html.twig', array(
            'vehicle' => $vehicle,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Vehicle entity.
     *
     * @Route("/samochod/{id}", name="_show")
     * @Method("GET")
     */
    public function showAction(Vehicle $vehicle)
    {
        $deleteForm = $this->createDeleteForm($vehicle);

        return $this->render('vehicle/show.html.twig', array(
            'vehicle' => $vehicle,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Vehicle entity.
     *
     * @Route("/samochod/{id}/edytujg", name="_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Vehicle $vehicle)
    {
        $deleteForm = $this->createDeleteForm($vehicle);
        $editForm = $this->createForm('AppBundle\Form\VehicleType', $vehicle);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($vehicle);
            $em->flush();

            return $this->redirectToRoute('_edit', array('id' => $vehicle->getId()));
        }

        return $this->render('vehicle/edit.html.twig', array(
            'vehicle' => $vehicle,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Vehicle entity.
     *
     * @Route("/samochod/{id}", name="_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Vehicle $vehicle)
    {
        $form = $this->createDeleteForm($vehicle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($vehicle);
            $em->flush();
        }

        return $this->redirectToRoute('_index');
    }

    /**
     * Creates a form to delete a Vehicle entity.
     *
     * @param Vehicle $vehicle The Vehicle entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Vehicle $vehicle)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('_delete', array('id' => $vehicle->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
