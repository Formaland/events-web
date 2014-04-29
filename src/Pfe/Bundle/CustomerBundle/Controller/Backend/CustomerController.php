<?php

namespace Pfe\Bundle\CustomerBundle\Controller\Backend;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Pfe\Bundle\CustomerBundle\Entity\Customer;
use Pfe\Bundle\CustomerBundle\Form\CustomerCreate;
use Pfe\Bundle\CustomerBundle\Form\CustomerEdit;

/**
 * Customer controller.
 *
 */
class CustomerController extends Controller
{

    /**
     * Lists all Customer entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('PfeCustomerBundle:Customer')->findAll();

        return $this->render('PfeCustomerBundle:Backend/Customer:index.html.twig', array(
            'entities' => $entities,

        ));
    }
    /**
     * Creates a new Customer entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Customer();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('customer_show', array('token' => $entity->getToken())));
        }

        return $this->render('PfeCustomerBundle:Backend/Customer:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a Customer entity.
    *
    * @param Customer $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Customer $entity)
    {
        $form = $this->createForm(new CustomerCreate(), $entity, array(
            'action' => $this->generateUrl('customer_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Customer entity.
     *
     */
    public function newAction()
    {
        $entity = new Customer();
        $form   = $this->createCreateForm($entity);

        return $this->render('PfeCustomerBundle:Backend/Customer:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Customer entity.
     *
     */
    public function showAction($token)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PfeCustomerBundle:Customer')->findOneBy(array('token' => $token));

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Customer entity.');
        }

        $deleteForm = $this->createDeleteForm($token);

        return $this->render('PfeCustomerBundle:Backend/Customer:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing Customer entity.
     *
     */
    public function editAction($token)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PfeCustomerBundle:Customer')->findOneBy(array('token' => $token));

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Customer entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($token);

        return $this->render('PfeCustomerBundle:Backend/Customer:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Customer entity.
    *
    * @param Customer $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Customer $entity)
    {
        $form = $this->createForm(new CustomerEdit(), $entity, array(
            'action' => $this->generateUrl('customer_update', array('token' => $entity->getToken())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Customer entity.
     *
     */
    public function updateAction(Request $request, $token)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PfeCustomerBundle:Customer')->findOneBy(array('token' => $token));

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Customer entity.');
        }

        $deleteForm = $this->createDeleteForm($token);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('customer_edit', array('token' => $token)));
        }

        return $this->render('PfeCustomerBundle:Backend/Customer:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Customer entity.
     *
     */
    public function deleteAction(Request $request, $token)
    {
        $deleteForm = $this->createDeleteForm($token);
        $deleteForm->handleRequest($request);

        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('PfeCustomerBundle:Customer')->findOneBy(array('token' => $token));

        if ($deleteForm->isValid()) {
            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Customer entity.');
            }

            $em->remove($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('customer'));
        }

        return $this->render('PfeCustomerBundle:Backend/Customer:delete.html.twig', array(
            'entity' => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to delete a Customer entity by id.
     *
     * @param mixed $token The entity token
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($token)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('customer_delete', array('token' => $token)))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    public function lockedAction(Request $request, $token)
    {
        $lockedForm = $this->createLockedForm($token);
        $lockedForm->handleRequest($request);

        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('PfeCustomerBundle:Customer')->findOneBy(array('token' => $token));

        if($lockedForm->isValid())
        {

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Customer entity.');
            }

            if ($entity->isLocked())
            {
                $entity->setLocked(false);
            }
            else
            {
                $entity->setLocked(true);
            }

            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('customer'));
        }

        return $this->render('PfeCustomerBundle:Backend/Customer:locked.html.twig', array(
            'entity' => $entity,
            'locked_form' => $lockedForm->createView(),
        ));
    }

    public function createLockedForm($token)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('customer_locked', array('token' => $token)))
            ->setMethod('PUT')
            ->getForm()
            ;
    }
}
