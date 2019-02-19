<?php

namespace FS\SolrBundle\Doctrine\Mapper;

use FS\SolrBundle\Doctrine\Hydration\HydrationModes;
use FS\SolrBundle\Doctrine\Mapper\Mapping\AbstractDocumentCommand;
use Solarium\QueryType\Update\Query\Document\Document;

interface EntityMapperInterface
{

    /**
     * @param MetaInformationInterface $metaInformation
     * @param object $entity
     *
     * @return Document
     */
    public function toDocument(MetaInformationInterface $metaInformation, object $entity);

    /**
     * @param \ArrayAccess  $document
     * @param object|string $sourceTargetEntity entity, entity-alias or classname
     *
     * @return object
     *
     * @throws SolrMappingException( if $sourceTargetEntity is null
     */
    public function toEntity(\ArrayAccess $document, $sourceTargetEntity);

    /**
     * @param string $mode
     */
    public function setHydrationMode($mode);
}
