<?php

declare(strict_types=1);


namespace FS\SolrBundle\Doctrine\Mapper\Driver;


use FS\SolrBundle\Doctrine\Annotation\AnnotationReader;

class AnnotationsDriver implements DriverInterface
{
    /**
     * @var AnnotationReader
     */
    protected $annotationReader;

    public function __construct(AnnotationReader $annotationReader)
    {
        $this->annotationReader = $annotationReader;
    }

    /**
     * @inheritdoc
     */
    public function hasDocumentDeclaration($entity)
    {
        return $this->annotationReader->hasDocumentDeclaration($entity);
    }

    /**
     * @inheritdoc
     */
    public function getFields($entity)
    {
        return $this->annotationReader->getFields($entity);
    }

    /**
     * @inheritdoc
     */
    public function getMethods($entity)
    {
        return $this->annotationReader->getMethods($entity);
    }

    /**
     * @inheritdoc
     */
    public function getIdentifier($entity)
    {
        return $this->annotationReader->getIdentifier($entity);
    }

    /**
     * @inheritdoc
     */
    public function getEntityBoost($entity)
    {
        return $this->annotationReader->getEntityBoost($entity);
    }

    /**
     * @inheritdoc
     */
    public function getDocumentIndex($entity)
    {
        return $this->annotationReader->getDocumentIndex($entity);
    }

    /**
     * @inheritdoc
     */
    public function isNested($entity)
    {
        return $this->annotationReader->isNested($entity);
    }

    /**
     * @param string $entity
     *
     * @return string
     */
    public function getSynchronizationCallback($entity)
    {
        return $this->annotationReader->getSynchronizationCallback($entity);
    }

    /**
     * @inheritdoc
     */
    public function getRepository($entity)
    {
        return $this->annotationReader->getRepository($entity);
    }

    public function getFieldMapping($entity)
    {
        return $this->annotationReader->getFieldMapping($entity);
    }

    /**
     * @inheritdoc
     */
    public function isOrm($entity)
    {
        return $this->annotationReader->isOrm($entity);
    }

    /**
     * @inheritdoc
     */
    public function isOdm($entity)
    {
        return $this->annotationReader->isOdm($entity);
    }
}