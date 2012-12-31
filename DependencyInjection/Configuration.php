<?php

namespace WXR\NewsBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('wxr_news');

        $rootNode
            ->children()
                ->scalarNode('translation_domain')->defaultValue('WXRNewsBundle')->end()
                ->arrayNode('post')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('manager')->defaultValue('wxr_news.post.manager.default')->end()
                        ->arrayNode('admin')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('class')->defaultValue('WXR\NewsBundle\Admin\Entity\PostAdmin')->end()
                                ->scalarNode('controller')->defaultValue('SonataAdminBundle:CRUD')->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
                ->arrayNode('category')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('manager')->defaultValue('wxr_news.category.manager.default')->end()
                        ->arrayNode('admin')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('class')->defaultValue('WXR\NewsBundle\Admin\Entity\CategoryAdmin')->end()
                                ->scalarNode('controller')->defaultValue('SonataAdminBundle:CRUD')->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
                ->arrayNode('tag')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('manager')->defaultValue('wxr_news.tag.manager.default')->end()
                        ->arrayNode('admin')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('class')->defaultValue('WXR\NewsBundle\Admin\Entity\TagAdmin')->end()
                                ->scalarNode('controller')->defaultValue('SonataAdminBundle:CRUD')->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
