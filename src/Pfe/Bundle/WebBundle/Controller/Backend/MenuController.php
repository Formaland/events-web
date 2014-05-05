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
                'routes' => array('pfe_page_index', 'pfe_page_new', 'pfe_page_edit'),
                'icon' => 'copy',
                'class' => 'start',
                'title' => 'sidebar.page.name',
                'submenu' => array(
                    array(
                        'route' => 'pfe_page_index',
                        'title' => 'sidebar.page.index'
                    ),
                    array(
                        'route' => 'pfe_page_new',
                        'title' => 'sidebar.page.new'
                    ),
                )
            ),
            array(
                'routes' => array('pfe_web_backend_dashboard'),
                'route' => 'customer',
                'icon' => 'user',
                'class' => 'start',
                'title' => 'sidebar.customer.name',
            ),
        );


        return $this->render('PfeWebBundle:Backend/Menu:sidebar.html.twig', array(
            'menu' => $menu,
            'route' => $request->get('_route')
        ));
    }

}