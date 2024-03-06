<?php

namespace Artgris\MaintenanceBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\HttpFoundation\Response;

/**
 * This is the class that validates and merges configuration from your app/config files.
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/configuration.html}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder("artgris_maintenance");
        $rootNode = $treeBuilder->getRootNode();

	    $rootNode
		    ->children()
                ->scalarNode("enable")->defaultValue(false)->end()
                ->scalarNode("response")->defaultValue(Response::HTTP_SERVICE_UNAVAILABLE)->end()
                ->arrayNode("ips")
                    ->prototype('scalar')->end()
                ->end()
		    ->end();

        return $treeBuilder;
    }
}
