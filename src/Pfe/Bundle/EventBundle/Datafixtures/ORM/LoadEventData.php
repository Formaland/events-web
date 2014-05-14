<?php

namespace Pfe\Bundle\EventBundle\Datafixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Pfe\Bundle\EventBundle\Entity\Event;
use Pfe\Bundle\EventBundle\Entity\EventTranslation;

class LoadEventData implements FixtureInterface {

    public function load(ObjectManager $manager)
    {
        $locales = array('fr', 'en');
        $events_translation = array();

        for($i = 1; $i <= 100; $i++)
        {
            $event = new Event();
            $event->setPrice(50,00 + ($i * 10));
            $event->setAddress('Address'. $i);
            $event->setCity('City'. $i);
            $event->setPostalCode(5000 + $i);
            $event->setCountry('TN');
            $event->setStartDate(new \DateTime());
            $event->setEndDate(new \DateTime());
            $event->setNumberPlace(100 + $i);
            $manager->persist($event);
            $manager->flush();

            foreach($locales as $locale)
            {
                $events_translation[$locale] = new EventTranslation();
                $events_translation[$locale]->setTitle('Event ' . $locale .' #' . $i);
                $events_translation[$locale]->setDescription('Description ' . $locale .' ' . $i);
                $events_translation[$locale]->setLocale($locale);
                $events_translation[$locale]->setTranslatable($event);

                $manager->persist($events_translation[$locale]);
                $manager->flush();
            }

        }
    }

} 