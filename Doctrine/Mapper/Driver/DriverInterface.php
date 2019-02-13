<?php

declare(strict_types=1);


namespace FS\SolrBundle\Doctrine\Mapper\Driver;


use FS\SolrBundle\Doctrine\Annotation\Id;

interface DriverInterface
{
    /**
     * @param object $entity
     *
     * @return boolean
     */
    public function hasDocumentDeclaration($entity);

    /**
     * @param object $entity
     *
     * @return array
     */
    public function getFields($entity);

    /**
     * @param object $entity
     *
     * @return array
     *
     * @throws \ReflectionException
     */
    public function getMethods($entity);

    /**
     * @param object $entity
     *
     * @return Id
     */
    public function getIdentifier($entity);

    /**
     * @param object $entity
     *
     * @return number
     */
    public function getEntityBoost($entity);

    /**
     * @param string $entity
     *
     * @return string
     */
    public function getSynchronizationCallback($entity);

    /**
     * @param object $entity
     *
     * @return bool
     */
    public function isNested($entity);

    /**
     * @param object $entity
     *
     * @return string
     */
    public function getDocumentIndex($entity);

    /**
     * @param object $entity
     *
     * @return string classname of repository
     */
    public function getRepository($entity);

    /**
     * returns all fields and field for identification
     *
     * @param object $entity
     *
     * @return array
     */
    public function getFieldMapping($entity);

    /**
     * @param object $entity
     *
     * @return bool
     */
    public function isOrm($entity);

    /**
     * @param object $entity
     *
     * @return bool
     */
    public function isOdm($entity);
}
