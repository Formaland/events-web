<?php

namespace Pfe\Bundle\PageBundle\Controller\Frontend;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

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

        $entity = $em->getRepository('PfePageBundle:Page')->findOneByLocaleAndSlug($request->getLocale(), $request->get('slug'));

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Page entity.');
        }

        if($entity->getTemplate() == 0)
        {
            return $this->render('PfePageBundle:Frontend/Page:default.html.twig', array(
                'entity' => $entity,
            ));
        }
        elseif($entity->getTemplate() == 1)
        {
            return $this->render('PfePageBundle:Frontend/Page:home.html.twig', array(
                'entity' => $entity,
            ));
        }
        elseif($entity->getTemplate() == 2)
        {
            return $this->render('PfePageBundle:Frontend/Page:contact.html.twig', array(
                'entity' => $entity,
            ));
        }
    }
}
