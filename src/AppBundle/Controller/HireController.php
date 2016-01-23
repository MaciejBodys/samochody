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
     * @Route("/{id}", name="zamowienia_show")
     * @Method("GET")
     */
    public function showAction(Hire $hire)
    {

        return $this->render('hire/show.html.twig', array(
            'hire' => $hire,
        ));
    }
}
