<?php

declare(strict_types=1);


namespace FS\SolrBundle\Doctrine\Mapper\Driver;


use Doctrine\Common\Persistence\Mapping\Driver\SymfonyFileLocator;
use FS\SolrBundle\Doctrine\Annotation\Id;

class YamlDriver implements DriverInterface
{

    const DEFAULT_FILE_EXTENSION = '.solr.yml';

    /**
     * {@inheritDoc}
     */
    public function __construct($locator, $fileExtension = self::DEFAULT_FILE_EXTENSION)
    {
        if ($locator instanceof SymfonyFileLocator) {
            $this->locator = $locator;
        } else {
            $this->locator = new SymfonyFileLocator((array) $locator, $fileExtension);
        }
    }

    /**
     * @param object $entity
     *
     * @return boolean
     */
    public function hasDocumentDeclaration($entity)
    {
        $mappingFile = $this->locator->findMappingFile(get_class($entity));
        $a = 1;
        // TODO: Implement hasDocumentDeclaration() method.
    }

    /**
     * @param object $entity
     *
     * @return array
     */
    public function getFields($entity)
    {
        // TODO: Implement getFields() method.
    }

    /**
     * @param object $entity
     *
     * @return array
     *
     * @throws \ReflectionException
     */
    public function getMethods($entity)
    {
        // TODO: Implement getMethods() method.
    }

    /**
     * @param object $entity
     *
     * @return Id
     */
    public function getIdentifier($entity)
    {
        // TODO: Implement getIdentifier() method.
    }

    /**
     * @param object $entity
     *
     * @return number
     */
    public function getEntityBoost($entity)
    {
        // TODO: Implement getEntityBoost() method.
    }

    /**
     * @param string $entity
     *
     * @return string
     */
    public function getSynchronizationCallback($entity)
    {
        // TODO: Implement getSynchronizationCallback() method.
    }

    /**
     * @param object $entity
     *
     * @return bool
     */
    public function isNested($entity)
    {
        // TODO: Implement isNested() method.
    }

    /**
     * @param object $entity
     *
     * @return string
     */
    public function getDocumentIndex($entity)
    {
        // TODO: Implement getDocumentIndex() method.
    }

    /**
     * @param object $entity
     *
     * @return string classname of repository
     */
    public function getRepository($entity)
    {
        // TODO: Implement getRepository() method.
    }

    /**
     * returns all fields and field for identification
     *
     * @param object $entity
     *
     * @return array
     */
    public function getFieldMapping($entity)
    {
        // TODO: Implement getFieldMapping() method.
    }

    /**
     * @param object $entity
     *
     * @return bool
     */
    public function isOrm($entity)
    {
        // TODO: Implement isOrm() method.
    }

    /**
     * @param object $entity
     *
     * @return bool
     */
    public function isOdm($entity)
    {
        // TODO: Implement isOdm() method.
    }
}
