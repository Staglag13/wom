<?php

namespace Staglag13\WomTestBundle\Model;

/**
 * Release model
 *
 * @package Staglag13\WomTestBundle
 * @author  Staglag13 <Staglag13@users.noreply.github.com>
 */
class ReleaseItem
{

    /** @var string */
    protected $_formats;

    /** @var int */
    protected $_trackCount;

    /**
     * Setter method for Formats
     *
     * @param string $formats
     *
     * @return null
     */
    public function setFormats($formats)
    {
        $this->_formats = $formats;
    }

    /**
     * Getter method for Formats
     *
     * @return string
     */
    public function getFormats()
    {
        return $this->_formats;
    }

    /**
     * Setter method for TrackCount
     *
     * @param int $trackCount
     *
     * @return null
     */
    public function setTrackCount($trackCount)
    {
        $this->_trackCount = $trackCount;
    }

    /**
     * Getter method for TrackCount
     *
     * @return int
     */
    public function getTrackCount()
    {
        return $this->_trackCount;
    }
}
