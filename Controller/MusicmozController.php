<?php

namespace Staglag13\WomTestBundle\Controller;

use Staglag13\WomTestBundle\Model\Client\ClientFactory;
use Staglag13\WomTestBundle\Model\Constants;
use Staglag13\WomTestBundle\Model\Filter\ReleaseFilterReleasedate;
use Staglag13\WomTestBundle\Model\Filter\ReleaseFilterTracks;
use Staglag13\WomTestBundle\Model\Mapping\MusicmozMapping;
use Staglag13\WomTestBundle\Model\ReleaseCollection;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Response;

/**
 * MusicMoz controller
 *
 * @package Staglag13\WomTestBundle
 * @author  Staglag13 <Staglag13@users.noreply.github.com>
 */
class MusicmozController extends Controller
{

    private $_filename = Constants::XML_TARGET_NAME;

    /**
     * the main controller to get the source xml, map and filter the result and generate the output xml
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        $sourceUrl = 'http://transfer.aoehost.de/recruiting-test/musicmoz.releases.xml';
        $targetXml = $this->_filename;

        // get data
        $client = ClientFactory::getClient('REST');
        $response = $client->request($sourceUrl, 'GET');

        // map data to release collection
        $sourceCollection = new ReleaseCollection();
        $sourceCollection->fill($response, new MusicmozMapping());

        // filter collection
        $filterList = $sourceCollection->getReleases();
        $filter = new ReleaseFilterReleasedate();
        // all releases before 01.01.2001
        $filterList = $filter->filter($filterList, '01.01.2001', 'lt');
        $filter = new ReleaseFilterTracks();
        // all releases with more than 10 tracks
        $filterList = $filter->filter($filterList, 10, 'gt');

        $targetCollection = new ReleaseCollection();
        $targetCollection->setReleases($filterList);
        $targetCollection->exportToXmlFile($targetXml);

        return $this->render('Staglag13WomTestBundle:Musicmoz:index.html.twig',
            array(
                'title' => 'Worldofmusic Application',
                'url'   => $sourceUrl,
                'file'  => $targetXml,
            )
        );
    }

    /**
     * download the xml file
     *
     * @return Response
     * @throws \Symfony\Component\Config\Definition\Exception\Exception
     */
    public function downloadAction()
    {
        $sourceXml = $this->_filename;

        if (file_exists($sourceXml)) {
            $response = new Response();
            $response->headers->set('Content-type', 'application/octet-stream');
            $response->headers->set('Content-Disposition', sprintf('attachment; filename="%s"', $sourceXml));
            $response->headers->set('Content-Length', filesize($sourceXml));

            $response->setContent(file_get_contents($sourceXml));
            $response->setStatusCode(200);
            $response->headers->set('Content-Transfer-Encoding', 'binary');
            $response->headers->set('Pragma', 'no-cache');
            $response->headers->set('Expires', '0');

            return $response;
        } else {
           throw new Exception ('File not found');
        }
    }
}
