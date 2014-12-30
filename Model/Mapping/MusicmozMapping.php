<?php

namespace Staglag13\WomTestBundle\Model\Mapping;

use Staglag13\WomTestBundle\Model\Release;
use Staglag13\WomTestBundle\Model\ReleaseItem;

/**
 * Mapper for MusicMoz (MusicMoz.org)
 *
 * @package Staglag13\WomTestBundle
 * @author  Staglag13 <Staglag13@users.noreply.github.com>
 */
Class MusicmozMapping implements DataMappingInterface
{

    /**
     * parse the input stream and map it to the release class.
     *
     * @param  string $input     MusicMoz XML
     *
     * @return array
     */
    public function parse($input)
    {
        $_womReleaseCollection = array();

        $xmlRootObject = simplexml_load_string($input);

        foreach ($xmlRootObject->category as $xmlCategoryObject) {

            // only categories with items are releases
            if (property_exists($xmlCategoryObject, 'item')) {

                $_womRelease = new Release();
                $_womRelease->setName($this->_convertSourceName($xmlCategoryObject['name']));
                /**
                 * @todo the number of items is not always the number of disc.
                 * tracklists with section or disc seams to have more discs but only one item.
                 */
                $_womRelease->setDiscCount(count($xmlCategoryObject->item));

                $releaseDate = $this->_convertSourceDate((string) $xmlCategoryObject->item[0]->releasedate, $_womRelease::DATE_FORMAT);
                $_womRelease->setReleaseDate($releaseDate);

                $totalNumberOfTracks = 0;
                foreach ($xmlCategoryObject->item as $xmlItemObject) {

                    $_womItem = new ReleaseItem();
                    $_womItem->setFormats((string) $xmlItemObject->formats);

                    $numberOfTracks = $this->_getTrackCount($xmlItemObject);
                    $totalNumberOfTracks += $numberOfTracks;
                    $_womItem->setTrackCount($numberOfTracks);

                    $_womRelease->setItem($_womItem);
                }

                $_womRelease->setTrackCount($totalNumberOfTracks);

                $_womReleaseCollection[] = $_womRelease;
            }
        }

        return $_womReleaseCollection;
    }

    /**
     * converts wom name
     * Example: Releases/Box_Sets/A/America's_Favorite_Folk_Artist => America's Favorite Folk Artist
     *
     * @param $name string
     *
     * @return string
     */
    protected function _convertSourceName($name)
    {
        $explodedName = explode('/', $name);
        return str_replace('_', ' ', array_pop($explodedName));
    }

    /**
     * Converts the date format from wom
     *
     * @param string $date
     * @param string $dateFormat
     *
     * @return bool|string
     */
    protected function _convertSourceDate($date, $dateFormat)
    {
        $dateParts = explode('.', $date);

        $year   = (isset($dateParts[0]) && is_numeric($dateParts[0])) ? $dateParts[0] : false;
        $month  = (isset($dateParts[1]) && is_numeric($dateParts[1])) ? $dateParts[1] : '01';
        $day    = (isset($dateParts[2]) && is_numeric($dateParts[2])) ? $dateParts[2] : '01';

        if ($year) {
            return sprintf($dateFormat, $day, $month, $year);
        } else {
            return null;
        }
    }

    /**
     * Return number of tracks
     *
     * @param $xmlItemObject
     *
     * @return int
     */
    protected function _getTrackCount($xmlItemObject)
    {
        $trackCount = 0;
        if (property_exists($xmlItemObject, 'tracklisting')) {

            // tracklisting has different models:
            if(property_exists($xmlItemObject->tracklisting, 'track')) {
                /**
                 * @code
                 * <tracklisting>
                 *     <track/>
                 * </tracklisting>
                 */
                $trackCount = count($xmlItemObject->tracklisting->track);

            } elseif (property_exists($xmlItemObject->tracklisting, 'section')) {
                /**
                 * @code
                 * <tracklisting>
                 *     <section>
                 *         <track/>
                 *  </section>
                 * </tracklisting>
                 */
                foreach($xmlItemObject->tracklisting->section as $xmlSectionObject) {
                    $trackCount += count($xmlSectionObject->track);
                }

            } elseif (property_exists($xmlItemObject->tracklisting, 'disc')) {
                /**
                 * @code
                 * <tracklisting>
                 *     <disc>
                 *         <track/>
                 *  </disc>
                 * </tracklisting>
                 */
                foreach($xmlItemObject->tracklisting->disc as $xmlDiscObject) {
                    $trackCount += count($xmlDiscObject->track);
                }
            }
        }

        return $trackCount;
    }
}