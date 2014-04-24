<?php

namespace Pfe\Bundle\WebBundle\Controller\Backend;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class MenuController extends Controller {

    public function sidebarAction(Request $request)
    {
        $menu = array(
            array(
                'route' => 'pfe_web_backend_dashboard',
                'icon' => 'dashboard',
                'class' => 'start',
                'title' => 'sidebar.dashboard.name',
            ),
            array(
                'routes' => array('pfe_web_backend_dashboard'),
                'icon' => 'user',
                'class' => 'start',
                'title' => 'sidebar.user.name',
                'submenu' => array(
                    array(
                        'route' => 'pfe_web_backend_dashboard',
                        'class' => 'start',
                        'title' => 'sidebar.user.index',
                    ),
                    array(
                        'route' => 'pfe_web_backend_dashboard',
                        'class' => 'start',
                        'title' => 'sidebar.user.new',
                    ),
                ),
            ),
        );


        return $this->render('PfeWebBundle:Backend/Menu:sidebar.html.twig', array(
            'menu' => $menu,
            'route' => $request->get('_route')
        ));
    }

}