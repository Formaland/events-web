<?php

namespace Pfe\Bundle\SeoBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class PfeSeoExtension extends Extension {

    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.xml');

        $config = $this->fixConfiguration($configs);

        $this->configureSeoMeta($config['meta'], $container);
        $this->configureClassesToCompile();

        $container->getDefinition('pfe.seo.twig.extension')
            ->replaceArgument(0, $config['encoding']);
    }

    /**
     * @param array            $config
     * @param ContainerBuilder $container
     */
    protected function configureSeoMeta(array $config, ContainerBuilder $container)
    {
        $definition = $container->getDefinition($config['default']);

        $definition->addMethodCall('setTitle', array($config['title']));
        $definition->addMethodCall('setMetas', array($config['metas']));
        $definition->addMethodCall('setHtmlAttributes', array($config['head']));
        $definition->addMethodCall('setSeparator', array($config['separator']));

        $container->setAlias('pfe.seo.meta', $config['default']);
    }

    /**
     * @param array $configs
     *
     * @return array
     */
    protected function fixConfiguration(array $configs)
    {
        // for now this configuration cannot be used as the key are normalized
        // $configuration = new Configuration();
        // $config = $this->processConfiguration($configuration, $configs);
        $config = $configs[0];

        // page settings
        $config['meta']              = isset($config['meta']) && is_array($config['meta'])  ? $config['meta'] : array();
        $config['meta']['default']   = isset($config['meta']['default'])  ? $config['meta']['default']  : 'pfe.seo.meta.default';
        $config['meta']['separator'] = isset($config['meta']['separator'])? $config['meta']['separator']: ' - ';
        $config['meta']['title']     = isset($config['meta']['title'])    ? $config['meta']['title']    : 'Sonata Project';
        $config['meta']['metas']     = isset($config['meta']['metas'])    ? $config['meta']['metas']    : array();
        $config['meta']['head']      = isset($config['meta']['head'])     ? $config['meta']['head']     : array();

        // twig settings
        $config['encoding']          = isset($config['encoding']) ? $config['encoding'] : 'UTF-8';

        return $config;
    }

    /**
     * Add class to compile
     */
    public function configureClassesToCompile()
    {
        $this->addClassesToCompile(array(
            "Pfe\\Bundle\\SeoBundle\\Seo\\SeoMeta",
            "Pfe\\Bundle\\SeoBundle\\Seo\\SeoMetaInterface",
            "Pfe\\Bundle\\SeoBundle\\Twig\\Extension\\SeoExtension",
        ));
    }
}
