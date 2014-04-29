<?php

namespace Pfe\Bundle\MenuBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('PfeMenuBundle:Default:index.html.twig', array('name' => $name));
    }
}
