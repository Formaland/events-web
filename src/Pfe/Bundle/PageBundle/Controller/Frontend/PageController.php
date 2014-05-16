<?php

namespace Pfe\Bundle\PageBundle\Controller\Frontend;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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


        $entity = $em->getRepository('PfePageBundle:Page')->findHome($request->get('locale'));

        if($entity){
            return $this->render('PfePageBundle:Frontend/Page:home.html.twig', array(
                'entity' => $entity,
            ));
        }
        else{
            return new Response($this->get('templating')->render('PfePageBundle:Frontend/Page:404.html.twig'), 404, array('Content-Type', 'text/html'));
        }
    }

    public function showAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $slug = $request->get('slug');
        $locale = $this->container->getParameter('locale');

        $entity = $em->getRepository('PfePageBundle:Page')->findOneByLocaleAndSlug($locale, $slug);

        if($entity){
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
        else{
            return new Response($this->get('templating')->render('PfePageBundle:Frontend/Page:404.html.twig'), 404, array('Content-Type', 'text/html'));
        }
    }
}
