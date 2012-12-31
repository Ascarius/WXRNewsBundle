<?php

namespace WXR\NewsBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

class WXRNewsExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $container->setParameter('wxr_news.translation_domain', $config['translation_domain']);

        $container->setAlias('wxr_news.post.manager', $config['post']['manager']);
        $container->setParameter('wxr_news.post.admin.class', $config['post']['admin']['class']);
        $container->setParameter('wxr_news.post.admin.controller', $config['post']['admin']['controller']);

        $container->setAlias('wxr_news.category.manager', $config['category']['manager']);
        $container->setParameter('wxr_news.category.admin.class', $config['category']['admin']['class']);
        $container->setParameter('wxr_news.category.admin.controller', $config['category']['admin']['controller']);

        $container->setAlias('wxr_news.tag.manager', $config['tag']['manager']);
        $container->setParameter('wxr_news.tag.admin.class', $config['tag']['admin']['class']);
        $container->setParameter('wxr_news.tag.admin.controller', $config['tag']['admin']['controller']);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');
    }
}
