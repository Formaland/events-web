<?php

namespace Pfe\Bundle\EventBundle\Datafixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Pfe\Bundle\EventBundle\Entity\Category;
use Pfe\Bundle\EventBundle\Entity\CategoryTranslation;

class LoadCategoryData implements FixtureInterface {

    public function load(ObjectManager $manager)
    {
        $locales = array('fr', 'en');
        $categories_translation = array();

        for($i = 1; $i <= 100; $i++)
        {
            $category = new Category();
            $manager->persist($category);
            $manager->flush();

            foreach($locales as $locale)
            {
                $categories_translation[$locale] = new CategoryTranslation();
                $categories_translation[$locale]->setTitle('Category ' . $locale .' #' . $i);
                $categories_translation[$locale]->setDescription('Description ' . $locale .' ' . $i);
                $categories_translation[$locale]->setLocale($locale);
                $categories_translation[$locale]->setTranslatable($category);

                $manager->persist($categories_translation[$locale]);
                $manager->flush();
            }

        }
    }

} 