<?php

namespace Pfe\Bundle\WebBundle\Listener;

use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class LocaleListener implements EventSubscriberInterface {

    private $container;

    public function getContainer() {
        return $this->container;
    }

    public function setContainer($container) {
        $this->container = $container;
    }

    public function onKernelRequest(GetResponseEvent $event) {

        $request = $event->getRequest();
        if (!$request->hasPreviousSession()) {
            return;
        }

        if ($request->get('locale') && in_array($request->get('locale'), $this->container->getParameter('locales'))) {
            $request->setLocale($request->get('locale'));
        } else {
            $uri = $request->getUri();
            $uriArray = explode('/', $uri);

            if (in_array($uriArray['3'], $this->container->getParameter('locales'))) {
                $request->setLocale($uriArray['3']);
            } else {
                $request->setLocale($this->container->getParameter('locale'));
            }
        }
    }

    static public function getSubscribedEvents() {
        return array(
            // must be registered before the default Locale listener
            KernelEvents::REQUEST => array(array('onKernelRequest', 17)),
        );
    }

}
