<?php

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Hire;

/**
 * Hire controller.
 *
 * @Route("/zamowienia")
 */
class HireController extends Controller
{
    /**
     * Lists all Hire entities.
     *
     * @Route("/", name="zamowienia_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $hires = $em->getRepository('AppBundle:Hire')->findAll();

        return $this->render('hire/index.html.twig', array(
            'hires' => $hires,
        ));
    }

    /**
     * Finds and displays a Hire entity.
     *
     * @Route("/{car}", name="zamowienia_hire")
     * @Method("GET")
     * @param $car
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function hireAction($car)
    {

        $hire = new Hire();

        $hire->setUser($this->getUser());
        $hire->setStatus('ROZPOCZĘTE');
        $hire->setCar($car);


        $em = $this->getDoctrine()->getManager();

        $em->persist($hire);

        $em->flush();

        $this->addFlash('succes', 'Pomyślnie dodałeś nowy pojazd');

        return $this->redirectToRoute('zamowienia_index');
    }
}
