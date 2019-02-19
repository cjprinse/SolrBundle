<?php

declare(strict_types=1);


namespace FS\SolrBundle\Doctrine\Mapper\Driver;


use Doctrine\Common\Persistence\Mapping\Driver\SymfonyFileLocator;
use Doctrine\Common\Persistence\Mapping\MappingException;
use FS\SolrBundle\Doctrine\Annotation\Field;
use FS\SolrBundle\Doctrine\Annotation\Id;
use Symfony\Component\Yaml\Yaml;

class YamlDriver implements DriverInterface
{
    const DEFAULT_FILE_EXTENSION = '.solr.yml';

    /**
     * @var array
     */
    protected $classCache = [];

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
        try {
            $this->getClassConfig(get_class($entity));

            return true;
        } catch (MappingException $e) {
            return false;
        }
    }

    /**
     * @param object $entity
     *
     * @return array
     */
    public function getFields($entity)
    {
        $config = $this->getClassConfig(get_class($entity));

        $fields = $config['fields'] ?? [];

        $annotations = [];


        foreach ($fields as $name => $field) {
            $annotation = new Field([
                'name' => $name,
                'fieldName' => $field['field'] ?? null,
                'type' => $field['type'] ?? 'string',
                'boost' => $field['boost'] ?? 0,
            ]);

            if (!empty($field['nested'])) {
                $annotation->nestedClass = $field['nested']['class'] ?? null;
                $annotation->mapper = $field['nested']['mapper'] ?? null;
            }

            $annotations[] = $annotation;

        }

        return $annotations;
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
        return [];
    }

    /**
     * @param object $entity
     *
     * @return Id
     */
    public function getIdentifierFields($entity)
    {
        $config = $this->getClassConfig(get_class($entity));

        $identifiers = [];

        foreach ($config['id'] as $key => $field) {
            if (is_array($field)) {
                $fieldValue = reset($field);
                $fieldName = key($field);
                $key = $fieldValue['field'] ?? $fieldName;
                $identifiers[$key] = $fieldName;
            } else {
                $identifiers[$field] = $field;
            }
        }

        return $identifiers;
    }

    /**
     * @param $entity
     * @return bool
     * @throws MappingException
     */
    public function getAutoGeneratedId($entity)
    {
        $config = $this->getClassConfig(get_class($entity));

        return (bool) ($config['autogenerate_id'] ?? false);
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
        $config = $this->getClassConfig(get_class($entity));

        return ($config['nested'] ?? false) === true;
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
        $config = $this->getClassConfig(get_class($entity));

        return $config['repository'] ?? null;
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
        $fields = $this->getFields($entity);

        $mapping = [];
        foreach ($fields as $field) {
            $mapping[$field->getNameWithAlias()] = $field->name;
        }

        foreach ($this->getIdentifierFields($entity) as $key => $field) {
            $mapping[$key] = $field;
        }

        return $mapping;
    }

    /**
     * @param object $entity
     *
     * @return bool
     */
    public function isOrm($entity)
    {
        $config = $this->getClassConfig(get_class($entity));

        return strtolower($config['type'] ?? '') === 'orm';
    }

    /**
     * @param object $entity
     *
     * @return bool
     */
    public function isOdm($entity)
    {
        $config = $this->getClassConfig(get_class($entity));

        return strtolower($config['type'] ?? '') === 'odm';
    }

    /**
     * @param string $className
     * @return array
     * @throws MappingException
     */
    protected function getClassConfig(string $className)
    {
        if (!isset($this->classCache[$className])) {
            $mappingFile = $this->locator->findMappingFile($className);
            $this->classCache = array_merge($this->classCache, $this->loadMappingFile($mappingFile));
        }

        return $this->classCache[$className];
    }

    /**
     * {@inheritDoc}
     */
    protected function loadMappingFile($file)
    {
        return Yaml::parse(file_get_contents($file));
    }
}
