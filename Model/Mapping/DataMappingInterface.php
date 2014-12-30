<?php

namespace Staglag13\WomTestBundle\Model\Mapping;

/**
 * An interface description for DataMapping classes.
 *
 * @package Staglag13\WomTestBundle
 * @author  Staglag13 <Staglag13@users.noreply.github.com>
 */
interface DataMappingInterface
{

    /**
     * parse the input stream and map it to the release class.
     *
     * @param string $input
     *
     * @return array
     */
    public function parse($input);
}