<?php

namespace Pfe\Bundle\EventBundle\Controller\Backend;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Pfe\Bundle\EventBundle\Entity\Event;
use Pfe\Bundle\EventBundle\Form\EventCreate;
use Pfe\Bundle\EventBundle\Form\EventEdit;
use Pfe\Bundle\EventBundle\Form\EventFilter;

/**
 * Event controller.
 *
 */
class EventController extends Controller
{

    /**
     * Lists all Event entities.
     *
     */
    public function indexAction(Request $request)
    {

        $form = $this->createFilterForm();
        $form->handleRequest($request);

        $em = $this->getDoctrine()->getManager();
        $locale = $this->container->getParameter('locale');

        if($form->isValid())
        {
            $criteria = $form->getData();
            $entities = $em->getRepository('PfeEventBundle:Event')->findAllByLocaleAndCriteria($locale, $criteria);
        }
        else
        {
            $entities = $em->getRepository('PfeEventBundle:Event')->findAllByLocale($locale);
        }

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $entities,
            $request->get('page', 1)
        );

        return $this->render('PfeEventBundle:Backend/Event:index.html.twig', array(
            'pagination' => $pagination,
            'form' => $form->createView(),
        ));
    }

    /**
     * Creates a form to filter a Event entity.
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createFilterForm()
    {
        $form = $this->createForm(new EventFilter(), null, array(
            'action' => $this->generateUrl('pfe_event_index'),
            'method' => 'POST',
        ));

        return $form;
    }

    /**
     * Creates a new Event entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Event();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->set('success', 'your request has been processed successfully');

            return $this->redirect($this->generateUrl('pfe_event_show', array('token' => $entity->getToken())));
        }

        $this->get('session')->getFlashBag()->set('error', 'please check your form');

        return $this->render('PfeEventBundle:Backend/Event:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a Event entity.
    *
    * @param Event $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Event $entity)
    {
        $form = $this->createForm(new EventCreate(), $entity, array(
            'action' => $this->generateUrl('pfe_event_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Event entity.
     *
     */
    public function newAction()
    {
        $entity = new Event();
        $form   = $this->createCreateForm($entity);

        return $this->render('PfeEventBundle:Backend/Event:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Event entity.
     *
     */
    public function showAction($token)
    {
        $em = $this->getDoctrine()->getManager();

        $locale = $this->container->getParameter('locale');

        $entity = $em->getRepository('PfeEventBundle:Event')->findOneByLocale($token, $locale);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Event entity.');
        }

        $deleteForm = $this->createDeleteForm($token);

        return $this->render('PfeEventBundle:Backend/Event:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing Event entity.
     *
     */
    public function editAction($token)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PfeEventBundle:Event')->findOneBy(array('token' => $token));

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Event entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($token);

        return $this->render('PfeEventBundle:Backend/Event:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Event entity.
    *
    * @param Event $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Event $entity)
    {
        $form = $this->createForm(new EventEdit(), $entity, array(
            'action' => $this->generateUrl('pfe_event_update', array('token' => $entity->getToken())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Event entity.
     *
     */
    public function updateAction(Request $request, $token)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PfeEventBundle:Event')->findOneBy(array('token' => $token));

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Event entity.');
        }

        $deleteForm = $this->createDeleteForm($token);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            $this->get('session')->getFlashBag()->set('success', 'your request has been processed successfully');

            return $this->redirect($this->generateUrl('pfe_event_edit', array('token' => $token)));
        }

        $this->get('session')->getFlashBag()->set('error', 'please check your form');

        return $this->render('PfeEventBundle:Backend/Event:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Event entity.
     *
     */
    public function deleteAction(Request $request, $token)
    {
        $form = $this->createDeleteForm($token);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('PfeEventBundle:Event')->findOneBy(array('token' => $token));

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Event entity.');
            }

            $em->remove($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->set('success', 'your request has been processed successfully');
        }

        $this->get('session')->getFlashBag()->set('error', 'please check your form');

        return $this->redirect($this->generateUrl('pfe_event'));
    }

    /**
     * Creates a form to delete a Event entity by id.
     *
     * @param mixed $token The entity token
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($token)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('pfe_event_delete', array('token' => $token)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
