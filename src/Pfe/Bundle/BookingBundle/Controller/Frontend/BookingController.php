<?php

namespace Pfe\Bundle\BookingBundle\Controller\Frontend;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Pfe\Bundle\BookingBundle\Entity\Booking;
use Pfe\Bundle\BookingBundle\Form\BookingCreate;

/**
 * Booking controller.
 *
 */
class BookingController extends Controller
{

    public function newAction(Request $request)
    {
        $entity = new Booking();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $event = $em->getRepository('PfeEventBundle:Event')->findOneBy(array('token' => $request->get('token')));
            $user = $this->get('security.context')->getToken()->getUser();
            $entity->setEvent($event);
            $entity->setUser($user);
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('frontend_event_show', array('token' => $request->get('token'))));
        }


    }

    /**
    * Creates a form to create a Customer entity.
    *
    * @param Booking $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Booking $entity)
    {
        $form = $this->createForm(new BookingCreate(), $entity, array(
            'action' => $this->generateUrl('customer_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }
}
