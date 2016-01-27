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

        if ($this->isGranted('ROLE_ADMIN')) {
            $hires = $em->getRepository('AppBundle:Hire')->findAll();
        } else {
            $hires = $em->getRepository('AppBundle:Hire')->findBy(['user' => $this->getUser()]);
        }

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

        $this->addFlash('Sukces', 'Pomyślnie złożyłeś zlecenie o wypożyczenie pojazd');

        return $this->redirectToRoute('zamowienia_index');
    }

    /**
     * Finds and displays a Hire entity.
     *
     * @Route("/oddane/{hire}", name="zamowienia_oddane")
     * @Method("GET")
     * @param Hire $hire
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @internal param $car
     */
    public function oddaneAction(Hire $hire)
    {
        $em = $this->getDoctrine()->getManager();

        $hire->setStatus('ODDANE');

        $em->flush();

        $this->addFlash('Sukces', 'Pomyślnie złożyłeś zlecenie o wypożyczenie pojazd');

        return $this->redirectToRoute('zamowienia_index');
    }
    /**
     * Finds and displays a Hire entity.
     *
     * @Route("/anulowane/{hire}", name="zamowienia_anulowane")
     * @Method("GET")
     * @param Hire $hire
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @internal param $car
     */
    public function anulowaneAction(Hire $hire)
    {
        $em = $this->getDoctrine()->getManager();

        $hire->setStatus('ANULOWANE');

        $em->flush();
        $this->addFlash('Sukces', 'Pomyślnie zmieniłeś status');

        return $this->redirectToRoute('zamowienia_index');
    }
    /**
     * Finds and displays a Hire entity.
     *
     * @Route("/zaplacone/{hire}", name="zamowienia_zaplacone")
     * @Method("GET")
     * @param Hire $hire
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @internal param $car
     */
    public function zaplaconeAction(Hire $hire)
    {
        $em = $this->getDoctrine()->getManager();

        $hire->setStatus('ZAPŁACONE');

        $em->flush();

        $this->addFlash('Sukces', 'Pomyślnie zmieniłeś status');

        return $this->redirectToRoute('zamowienia_index');
    }
}
