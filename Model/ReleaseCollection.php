<?php

namespace Staglag13\WomTestBundle\Model;

use Staglag13\WomTestBundle\Model\Mapping\DataMappingInterface;

/**
 * Collection of releases
 *
 * @package Staglag13\WomTestBundle
 * @author  Staglag13 <Staglag13@users.noreply.github.com>
 */
class ReleaseCollection
{
    /** @var array  */
    public $releases = array();

    /**
     * fill the release collection by mapping data to release using the given mapper class
     *
     * @param                      $sourceData
     * @param DataMappingInterface $mapper
     *
     * @return null
     */
    public function fill($sourceData, DataMappingInterface $mapper) {
        $this->releases = $mapper->parse($sourceData);
    }

    /**
     * Setter method for Releases
     *
     * @param array $releases
     *
     * @return null
     */
    public function setReleases($releases)
    {
        $this->releases = $releases;
    }

    /**
     * Getter method for Releases
     *
     * @return array
     */
    public function getReleases()
    {
        return $this->releases;
    }

    /**
     * export release collection to xml file
     *
     * @param $filename
     *
     * @return null
     */
    public function exportToXmlFile($filename){


        $xmlWriter = new \XMLWriter();

        $xmlWriter->openUri($filename);
        $xmlWriter->startDocument('1.0','UTF-8');
        $xmlWriter->startElement('matchingReleases');

        foreach ($this->getReleases() as $release) {

            $xmlWriter->startElement('release');

            /** @var Release $release */
            $xmlWriter->writeElement('name', $release->getName());
            $xmlWriter->writeElement('trackCount', $release->getTrackCount());

            $xmlWriter->endElement(); // release
        }

        $xmlWriter->endElement(); // matchingReleases
        $xmlWriter->endDocument();

    }
}
