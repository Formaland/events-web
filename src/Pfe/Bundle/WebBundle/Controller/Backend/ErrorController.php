<?php

namespace Pfe\Bundle\WebBundle\Controller\Backend;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ErrorController extends Controller
{
    public function notFoundAction()
    {
        return $this->render('PfeWebBundle:Backend/Error:404.html.twig');
    }
}