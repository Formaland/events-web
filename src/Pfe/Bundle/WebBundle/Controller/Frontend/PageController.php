<?php

namespace Pfe\Bundle\WebBundle\Controller\Frontend;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PageController extends Controller
{
    public function homeAction()
    {
        $seo = $this->get('pfe.seo.meta');
        $seo->setTitle('Un titre de test')
            ->addMeta('name', 'description', 'Un exemple de description seo pour la page home');
        return $this->render('PfeWebBundle:Frontend/Page:home.html.twig');
    }
}