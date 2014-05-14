<?php

namespace Pfe\Bundle\WebBundle\Controller\Frontend;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class MenuController extends Controller {

    public function mainAction(Request $request)
    {

        return $this->render('PfeWebBundle:Frontend/Menu:main.html.twig', array(
            'route' => $request->get('_route')
        ));
    }

    public function footerAction(Request $request)
    {

        return $this->render('PfeWebBundle:Frontend/Menu:footer.html.twig', array(
            'route' => $request->get('_route')
        ));
    }

}