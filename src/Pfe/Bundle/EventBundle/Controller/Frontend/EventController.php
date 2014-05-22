<?php

namespace Pfe\Bundle\EventBundle\Controller\Frontend;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Pfe\Bundle\EventBundle\Entity\Event;
use Pfe\Bundle\BookingBundle\Entity\Booking;
use Pfe\Bundle\BookingBundle\Form\BookingCreate;

/**
 * Event controller.
 *
 */
class EventController extends Controller
{

    /**
     * Finds and displays a Event entity.
     *
     */
    public function showAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('PfeEventBundle:Event')->findOneBySlugAndLocale($request->get('slug'), $request->getLocale());

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Event entity.');
        }

        $bookingForm = $this->createBookingForm($entity->getSlug());

        return $this->render('PfeEventBundle:Frontend/Event:show.html.twig', array(
            'entity'      => $entity,
            'booking_form' => $bookingForm->createView(),        ));
    }

    /**
     * Creates a form to create a Event entity.
     *
     * @param Booking $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createBookingForm($slug)
    {
        $form = $this->createForm(new BookingCreate(), null, array(
            'action' => $this->generateUrl('pfe_frontend_booking_create', array('slug' => $slug)),
            'method' => 'POST',
        ));

        return $form;
    }

}
