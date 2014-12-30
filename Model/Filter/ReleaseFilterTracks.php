<?php

namespace Staglag13\WomTestBundle\Model\Filter;

use Staglag13\WomTestBundle\Model\Release;
use Symfony\Component\Config\Definition\Exception\Exception;

/**
 * Release Filter classes for track filter.
 *
 * @package Staglag13\WomTestBundle
 * @author  Staglag13 <Staglag13@users.noreply.github.com>
 */
class ReleaseFilterTracks extends ReleaseFilterAbstract
{

    /**
     * filters collection by tracks
     *
     * @param  array $collection
     * @param  $filterValue
     * @param  $filterOperator [gt|lt|eq|gte|lte]
     *
     * @return array
     * @throws \Symfony\Component\Config\Definition\Exception\Exception
     */
    public function filter(array $collection, $filterValue, $filterOperator)
    {
        $filteredCollection = array();

        foreach ($collection as $entry) {

            if ($entry instanceof Release) {

                $value = $entry->getTrackCount();

                if (!empty($value) && $this->comparison($value, $filterValue, $filterOperator)) {
                    $filteredCollection[] = $entry;
                }
            } else {
                throw new Exception ('Unknown collection object ['.__METHOD__.']');
            }

        }

        return $filteredCollection;
    }
}
