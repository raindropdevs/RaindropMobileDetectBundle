<?php

namespace Raindrop\MobileDetectBundle\DependencyInjection;

use Raindrop\MobileDetectBundle\EventListener\RequestListener;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('raindrop_mobile_detect');

        // Here you should define the parameters that are allowed to
        // configure your bundle. See the documentation linked above for
        // more information on that topic.

        $rootNode
            ->children()
                ->arrayNode('redirect')
                    ->children()
                        ->arrayNode('mobile')
                            ->isRequired()
                            ->children()
                                ->booleanNode('is_enabled')->defaultFalse()->end()
                                ->scalarNode('host')->defaultNull()->end()
                                ->scalarNode('status_code')->defaultValue(302)->cannotBeEmpty()->end()
                                ->scalarNode('action')->defaultValue(RequestListener::REDIRECT)->cannotBeEmpty()->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}
