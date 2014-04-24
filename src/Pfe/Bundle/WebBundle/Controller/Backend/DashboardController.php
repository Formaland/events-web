<?php

namespace Pfe\Bundle\WebBundle\Controller\Backend;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DashboardController extends Controller
{
    public function indexAction()
    {
        return $this->render('PfeWebBundle:Backend/Dashboard:index.html.twig');
    }
}