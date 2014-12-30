<?php

namespace Staglag13\WomTestBundle\Model\Filter;

use Symfony\Component\Config\Definition\Exception\Exception;

/**
 * An abstract description for ReleaseFilter classes.
 *
 * @package Staglag13\WomTestBundle
 * @author  Staglag13 <Staglag13@users.noreply.github.com>
 */
abstract class ReleaseFilterAbstract implements ReleaseFilterInterface
{

    /**
     * filters collection
     *
     * @param array $collection
     * @param  $filterValue
     * @param  $filterOperator [gt|lt|eq|gte|lte]
     */
    public abstract function filter(array $collection, $filterValue, $filterOperator);

    /**
     * compares to values by given operator
     *
     * @param  $value
     * @param  $filterValue
     * @param  $filterOperator [gt|lt|eq|gte|lte]
     *
     * @return bool
     * @throws \Symfony\Component\Config\Definition\Exception\Exception
     */
    protected function comparison ($value, $filterValue, $filterOperator) {

        switch ($filterOperator) {
            case 'gt':
                if ($value > $filterValue) {
                    return true;
                }
                break;
            case 'lt':
                if ($value < $filterValue) {
                    return true;
                }
                break;
            case 'eq':
                if ($value == $filterValue) {
                    return true;
                }
                break;
            case 'gte':
                if ($value >= $filterValue) {
                    return true;
                }
                break;
            case 'lte':
                if ($value <= $filterValue) {
                    return true;
                }
                break;
            default:
                throw new Exception ('Error: unknown filter operator ['.__METHOD__.']');
        }
        return false;
    }
}

