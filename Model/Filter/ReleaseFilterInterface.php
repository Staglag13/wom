<?php

namespace Staglag13\WomTestBundle\Model\Filter;

/**
 * An interface description for ReleaseFilter classes.
 *
 * @package Staglag13\WomTestBundle
 * @author  Staglag13 <Staglag13@users.noreply.github.com>
 */
interface ReleaseFilterInterface
{

    /**
     * filters collection
     *
     * @param array $collection
     * @param $filterValue
     * @param $filterOperator [gt|lt|eq|gte|lte]
     */
    public function filter(array $collection, $filterValue, $filterOperator);
}
