<?php

namespace Pfe\Bundle\PageBundle\Controller\Frontend;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Pfe\Bundle\BookingBundle\Entity\Booking;
use Pfe\Bundle\BookingBundle\Form\BookingCreate;

/**
 * Page controller.
 *
 */
class PageController extends Controller
{

    /**
     * Home Page entity.
     *
     */
    public function homeAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PfePageBundle:Page')->findHome($request->getLocale());

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Page entity.');
        }

        return $this->render('PfePageBundle:Frontend/Page:home.html.twig', array(
            'entity' => $entity,
        ));
    }

    public function showAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $page = $em->getRepository('PfePageBundle:Page')->findOneByLocaleAndSlug($request->getLocale(), $request->get('slug'));

        if (!$page) {
            throw $this->createNotFoundException('Unable to find Page entity.');
        }

        if($page->getTemplate() == 0)
        {
            return $this->render('PfePageBundle:Frontend/Page:default.html.twig', array(
                'page' => $page,
            ));
        }
        elseif($page->getTemplate() == 1)
        {
            return $this->render('PfePageBundle:Frontend/Page:home.html.twig', array(
                'page' => $page,
            ));
        }
        elseif($page->getTemplate() == 2)
        {
            return $this->render('PfePageBundle:Frontend/Page:contact.html.twig', array(
                'page' => $page,
            ));
        }
        elseif($page->getTemplate() == 3)
        {
            $events = $em->getRepository('PfeEventBundle:Event')->findAllByLocale($request->getLocale());

            $paginator = $this->get('knp_paginator');
            $pagination = $paginator->paginate(
                $events,
                $request->get('page', 1)
            );

            return $this->render('PfePageBundle:Frontend/Page:events.html.twig', array(
                'pagination' => $pagination,
                'page' => $page,
            ));
        }
    }
}
