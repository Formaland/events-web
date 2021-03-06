<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Symfony\Bundle\AsseticBundle\AsseticBundle(),
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),

            new Pfe\Bundle\WebBundle\PfeWebBundle(),
            new Pfe\Bundle\CustomerBundle\PfeCustomerBundle(),
            new Pfe\Bundle\PageBundle\PfePageBundle(),
            new Pfe\Bundle\EventBundle\PfeEventBundle(),
            new Pfe\Bundle\BookingBundle\PfeBookingBundle(),

            new FOS\UserBundle\FOSUserBundle(),
            new Ornicar\GravatarBundle\OrnicarGravatarBundle(),
            new A2lix\TranslationFormBundle\A2lixTranslationFormBundle(),
            new A2lix\I18nDoctrineBundle\A2lixI18nDoctrineBundle(),
            new Knp\Bundle\PaginatorBundle\KnpPaginatorBundle(),
            new Avalanche\Bundle\ImagineBundle\AvalancheImagineBundle(),
            new JMS\Payment\CoreBundle\JMSPaymentCoreBundle(),
        );

        if (in_array($this->getEnvironment(), array('dev', 'test'))) {
            $bundles[] = new Doctrine\Bundle\FixturesBundle\DoctrineFixturesBundle();
            $bundles[] = new Ws\Bundle\GeneratorBundle\WsGeneratorBundle();
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
        }

        return $bundles;
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__.'/config/config_'.$this->getEnvironment().'.yml');
    }
}
