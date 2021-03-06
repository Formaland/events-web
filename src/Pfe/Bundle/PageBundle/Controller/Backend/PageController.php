<?php

namespace Pfe\Bundle\PageBundle\Controller\Backend;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Pfe\Bundle\PageBundle\Entity\Page;
use Pfe\Bundle\PageBundle\Form\PageCreate;
use Pfe\Bundle\PageBundle\Form\PageEdit;

/**
 * Page controller.
 *
 */
class PageController extends Controller
{

    /**
     * Lists all Page entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $locale = $this->container->getParameter('locale');

        $entities = $em->getRepository('PfePageBundle:Page')->findAllByLocale($locale);

        return $this->render('PfePageBundle:Backend/Page:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Page entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Page();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->set('success', 'your request has been processed successfully');

            return $this->redirect($this->generateUrl('pfe_page_show', array('token' => $entity->getToken())));
        }

        $this->get('session')->getFlashBag()->set('error', 'please check your form');

        return $this->render('PfePageBundle:Backend/Page:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a Page entity.
    *
    * @param Page $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Page $entity)
    {
        $form = $this->createForm(new PageCreate(), $entity, array(
            'action' => $this->generateUrl('pfe_page_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Page entity.
     *
     */
    public function newAction()
    {
        $entity = new Page();
        $form   = $this->createCreateForm($entity);

        return $this->render('PfePageBundle:Backend/Page:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Page entity.
     *
     */
    public function showAction($token)
    {
        $em = $this->getDoctrine()->getManager();

        $locale = $this->container->getParameter('locale');

        $entity = $em->getRepository('PfePageBundle:Page')->findOneByLocale($token, $locale);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Page entity.');
        }

        $deleteForm = $this->createDeleteForm($token);

        return $this->render('PfePageBundle:Backend/Page:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing Page entity.
     *
     */
    public function editAction($token)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PfePageBundle:Page')->findOneBy(array('token' => $token));

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Page entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($token);

        return $this->render('PfePageBundle:Backend/Page:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Page entity.
    *
    * @param Page $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Page $entity)
    {
        $form = $this->createForm(new PageEdit(), $entity, array(
            'action' => $this->generateUrl('pfe_page_update', array('token' => $entity->getToken())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Page entity.
     *
     */
    public function updateAction(Request $request, $token)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PfePageBundle:Page')->findOneBy(array('token' => $token));

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Page entity.');
        }

        $deleteForm = $this->createDeleteForm($token);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            $this->get('session')->getFlashBag()->set('success', 'your request has been processed successfully');

            return $this->redirect($this->generateUrl('pfe_page_edit', array('token' => $token)));
        }

        $this->get('session')->getFlashBag()->set('error', 'please check your form');

        return $this->render('PfePageBundle:Backend/Page:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Page entity.
     *
     */
    public function deleteAction(Request $request, $token)
    {
        $form = $this->createDeleteForm($token);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('PfePageBundle:Page')->findOneBy(array('token' => $token));

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Page entity.');
            }

            $em->remove($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->set('success', 'your request has been processed successfully');
        }

        $this->get('session')->getFlashBag()->set('error', 'please check your form');

        return $this->redirect($this->generateUrl('pfe_page'));
    }

    /**
     * Creates a form to delete a Page entity by id.
     *
     * @param mixed $token The entity token
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($token)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('pfe_page_delete', array('token' => $token)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
