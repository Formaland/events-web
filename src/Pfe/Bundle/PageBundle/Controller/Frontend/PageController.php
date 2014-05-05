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
    public function homeAction()
    {
        $em = $this->getDoctrine()->getManager();

        $locale = $this->container->getParameter('locale');

        $entity = $em->getRepository('PfePageBundle:Page')->findHome($locale);

        return $this->render('PfePageBundle:Frontend/Page:home.html.twig', array(
            'entity' => $entity,
        ));
    }

    public function showAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $slug = $request->get('slug');
        $locale = $this->container->getParameter('locale');

        $entity = $em->getRepository('PfePageBundle:Page')->findOneByLocaleAndSlug($locale, $slug);

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
