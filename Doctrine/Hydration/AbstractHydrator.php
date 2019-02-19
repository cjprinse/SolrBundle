<?php

declare(strict_types=1);


namespace FS\SolrBundle\Doctrine\Hydration;


abstract class AbstractHydrator
{
    /**
     * @param $className
     * @return object
     * @throws \ReflectionException
     */
    protected function createEmpty($className)
    {
        $reflection = new \ReflectionClass($className);

        return $reflection->newInstanceWithoutConstructor();
    }
}
