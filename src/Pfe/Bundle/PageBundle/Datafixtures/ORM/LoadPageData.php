<?php

namespace Pfe\Bundle\PageBundle\Datafixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Pfe\Bundle\PageBundle\Entity\Page;
use Pfe\Bundle\PageBundle\Entity\PageTranslation;

class LoadPageData implements FixtureInterface {

    public function load(ObjectManager $manager)
    {
        /*
        $locales = array('fr', 'en');
        $events_translation = array();

        $event = new Page();
        $event->setTemplate(1);
        $manager->persist($event);
        $manager->flush();

        foreach($locales as $locale)
        {
            $events_translation[$locale] = new PageTranslation();
            $events_translation[$locale]->setTitle('Acceuil');
            $events_translation[$locale]->setContent('.');
            $events_translation[$locale]->setLocale($locale);
            $events_translation[$locale]->setTranslatable($event);

            $manager->persist($events_translation[$locale]);
            $manager->flush();
        }

        $event = new Page();
        $event->setTemplate(3);
        $manager->persist($event);
        $manager->flush();

        $events_translation = array();

        foreach($locales as $locale)
        {
            $events_translation[$locale] = new PageTranslation();
            $events_translation[$locale]->setTitle('Evenements');
            $events_translation[$locale]->setContent('.');
            $events_translation[$locale]->setLocale($locale);
            $events_translation[$locale]->setTranslatable($event);

            $manager->persist($events_translation[$locale]);
            $manager->flush();
        }

        $event = new Page();
        $event->setTemplate(2);
        $manager->persist($event);
        $manager->flush();

        $events_translation = array();

        foreach($locales as $locale)
        {
            $events_translation[$locale] = new PageTranslation();
            $events_translation[$locale]->setTitle('Contact');
            $events_translation[$locale]->setContent('.');
            $events_translation[$locale]->setLocale($locale);
            $events_translation[$locale]->setTranslatable($event);

            $manager->persist($events_translation[$locale]);
            $manager->flush();
        }
        */
    }

} 