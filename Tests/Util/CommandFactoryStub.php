<?php
namespace FS\SolrBundle\Tests\Util;

use FS\SolrBundle\Doctrine\Annotation\AnnotationReader;
use FS\SolrBundle\Doctrine\Mapper\Driver\AnnotationsDriver;
use FS\SolrBundle\Doctrine\Mapper\Mapping\CommandFactory;
use FS\SolrBundle\Doctrine\Mapper\Mapping\MapAllFieldsCommand;
use FS\SolrBundle\Doctrine\Mapper\Mapping\MapIdentifierCommand;
use FS\SolrBundle\Doctrine\Mapper\MetaInformationFactory;

class CommandFactoryStub
{
    /**
     *
     * @return \FS\SolrBundle\Doctrine\Mapper\Mapping\CommandFactory
     */
    public static function getFactoryWithAllMappingCommand()
    {
        $reader = new AnnotationReader(new \Doctrine\Common\Annotations\AnnotationReader());
        $driver = new AnnotationsDriver($reader);

        $commandFactory = new CommandFactory();
        $commandFactory->add(new MapAllFieldsCommand(new MetaInformationFactory($driver)), 'all');
        $commandFactory->add(new MapIdentifierCommand(), 'identifier');

        return $commandFactory;
    }
}

