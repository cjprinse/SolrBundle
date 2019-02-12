<?php

namespace FS\SolrBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{

    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('fs_solr');
        $rootNode->children()
            ->arrayNode('endpoints')
                ->useAttributeAsKey('name')
                ->prototype('array')
                    ->children()
                        ->scalarNode('dsn')->end()
                        ->scalarNode('scheme')->end()
                        ->scalarNode('host')->end()
                        ->scalarNode('port')->end()
                        ->scalarNode('path')->end()
                        ->scalarNode('core')->end()
                        ->scalarNode('timeout')->end()
                        ->booleanNode('active')->defaultValue(true)->end()
                    ->end()
                ->end()
            ->end()
            ->scalarNode('mapping_type')
                ->defaultValue('annotations')
                ->validate()
                    ->ifTrue(
                        function($s) {
                            return !in_array($s, ['annotations', 'yaml']);
                        }
                    )
                    ->thenInvalid('mapping_type must be "annotations" or "yaml"')
                    ->end()
            ->end()
            ->booleanNode('auto_index')->defaultValue(true)->end()
        ->end();

        return $treeBuilder;
    }
}
