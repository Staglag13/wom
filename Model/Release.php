<?php

namespace Staglag13\WomTestBundle\Model;

/**
 * Release model
 *
 * @package Staglag13\WomTestBundle
 * @author  Staglag13 <Staglag13@users.noreply.github.com>
 */
class Release
{
    const DATE_FORMAT = '%s.%s.%s';

    /** @var string */
    protected  $_name;

    /** @var int */
    protected $_discCount;

    /** @var int */
    protected $_trackCount;

    /** @var string */
    protected $_releaseDate;

    /**
     * Setter method for ReleaseDate
     *
     * @param string $releaseDate
     *
     * @return null
     */
    public function setReleaseDate($releaseDate)
    {
        $this->_releaseDate = $releaseDate;
    }

    /**
     * Getter method for ReleaseDate
     *
     * @return string
     */
    public function getReleaseDate()
    {
        return $this->_releaseDate;
    }

    /** @var array  */
    protected $_itemCollection = array();

    /**
     * Setter method for DiscCount
     *
     * @param int $discCount
     *
     * @return null
     */
    public function setDiscCount($discCount)
    {
        $this->_discCount = (int) $discCount;
    }

    /**
     * Getter method for DiscCount
     *
     * @return int
     */
    public function getDiscCount()
    {
        return $this->_discCount;
    }

    /**
     * Setter method for Name
     *
     * @param string $name
     *
     * @return null
     */
    public function setName($name)
    {
        $this->_name = $name;
    }

    /**
     * Getter method for Name
     *
     * @return string
     */
    public function getName()
    {
        return $this->_name;
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
        $this->_trackCount = (int) $trackCount;
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

    /**
     * Setter method for ItemCollection
     *
     * @param ReleaseItem $item
     *
     * @return null
     */
    public function setItem(ReleaseItem $item)
    {
        $this->_itemCollection[] = $item;
    }

    /**
     * Getter method for ItemCollection
     *
     * @return array
     */
    public function getItemCollection()
    {
        return $this->_itemCollection;
    }
}
