<?php

namespace Pfe\Bundle\BookingBundle\Controller\Backend;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Pfe\Bundle\BookingBundle\Entity\Booking;
use Pfe\Bundle\BookingBundle\Form\BookingCreate;
use Pfe\Bundle\BookingBundle\Form\BookingEdit;

/**
 * Booking controller.
 *
 */
class BookingController extends Controller
{

    /**
     * Lists all Booking entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $locale = $this->container->getParameter('locale');

        $entities = $em->getRepository('PfeBookingBundle:Booking')->findAllByLocale($locale);

        return $this->render('PfeBookingBundle:Booking:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Booking entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Booking();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->set('success', 'your request has been processed successfully');

            return $this->redirect($this->generateUrl('booking_show', array('token' => $entity->getToken())));
        }

        $this->get('session')->getFlashBag()->set('error', 'please check your form');

        return $this->render('PfeBookingBundle:Booking:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a Booking entity.
    *
    * @param Booking $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Booking $entity)
    {
        $form = $this->createForm(new BookingCreate(), $entity, array(
            'action' => $this->generateUrl('booking_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Booking entity.
     *
     */
    public function newAction()
    {
        $entity = new Booking();
        $form   = $this->createCreateForm($entity);

        return $this->render('PfeBookingBundle:Booking:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Booking entity.
     *
     */
    public function showAction($token)
    {
        $em = $this->getDoctrine()->getManager();

        $locale = $this->container->getParameter('locale');

        $entity = $em->getRepository('PfeBookingBundle:Booking')->findOneByLocale($token, $locale);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Booking entity.');
        }

        $deleteForm = $this->createDeleteForm($token);

        return $this->render('PfeBookingBundle:Booking:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing Booking entity.
     *
     */
    public function editAction($token)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PfeBookingBundle:Booking')->findOneBy(array('token' => $token));

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Booking entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($token);

        return $this->render('PfeBookingBundle:Booking:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Booking entity.
    *
    * @param Booking $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Booking $entity)
    {
        $form = $this->createForm(new BookingEdit(), $entity, array(
            'action' => $this->generateUrl('booking_update', array('token' => $entity->getToken())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Booking entity.
     *
     */
    public function updateAction(Request $request, $token)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PfeBookingBundle:Booking')->findOneBy(array('token' => $token));

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Booking entity.');
        }

        $deleteForm = $this->createDeleteForm($token);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            $this->get('session')->getFlashBag()->set('success', 'your request has been processed successfully');

            return $this->redirect($this->generateUrl('booking_edit', array('token' => $token)));
        }

        $this->get('session')->getFlashBag()->set('error', 'please check your form');

        return $this->render('PfeBookingBundle:Booking:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Booking entity.
     *
     */
    public function deleteAction(Request $request, $token)
    {
        $form = $this->createDeleteForm($token);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('PfeBookingBundle:Booking')->findOneBy(array('token' => $token));

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Booking entity.');
            }

            $em->remove($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->set('success', 'your request has been processed successfully');
        }

        $this->get('session')->getFlashBag()->set('error', 'please check your form');

        return $this->redirect($this->generateUrl('booking'));
    }

    /**
     * Creates a form to delete a Booking entity by id.
     *
     * @param mixed $token The entity token
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($token)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('booking_delete', array('token' => $token)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
