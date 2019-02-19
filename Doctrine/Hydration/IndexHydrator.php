<?php

namespace FS\SolrBundle\Doctrine\Hydration;

use FS\SolrBundle\Doctrine\Mapper\MetaInformationInterface;

/**
 * Hydrates blank Entity from Document
 */
class IndexHydrator extends AbstractHydrator implements HydratorInterface
{
    /**
     * @var HydratorInterface
     */
    private $valueHydrator;

    /**
     * @param HydratorInterface $valueHydrator
     */
    public function __construct(HydratorInterface $valueHydrator)
    {
        $this->valueHydrator = $valueHydrator;
    }

    /**
     * {@inheritdoc}
     */
    public function hydrate($document, MetaInformationInterface $metaInformation, $target = null)
    {
        $target = $target ?? $this->createEmpty($metaInformation->getClassName());

        return $this->valueHydrator->hydrate($document, $metaInformation, $target);
    }
} 
