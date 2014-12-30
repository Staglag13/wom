<?php

namespace Staglag13\WomTestBundle\Command;

use Staglag13\WomTestBundle\Model\Client\ClientFactory;
use Staglag13\WomTestBundle\Model\Constants;
use Staglag13\WomTestBundle\Model\Filter\ReleaseFilterReleasedate;
use Staglag13\WomTestBundle\Model\Filter\ReleaseFilterTracks;
use Staglag13\WomTestBundle\Model\Mapping\MusicmozMapping;
use Staglag13\WomTestBundle\Model\ReleaseCollection;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * MusicMoz command
 *
 * @package Staglag13\WomTestBundle
 * @author  Staglag13 <Staglag13@users.noreply.github.com>
 */

class MusicmozCommand extends ContainerAwareCommand
{

    /**
     * Command configuration
     *
     * @return null
     */
    protected function configure()
    {
        $this->setName('musicmoz:run')->setDescription('Run the Musicmoz Test');
    }

    /**
     * Command action to get the source xml, map and filter the result and generate the output xml
     *
     * @param  InputInterface $input
     * @param  OutputInterface $output
     *
     * @return null
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $sourceUrl = 'http://transfer.aoehost.de/recruiting-test/musicmoz.releases.xml';
        $targetXml = Constants::XML_TARGET_PATH.Constants::XML_TARGET_NAME;


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

        $text = "created {$targetXml}";

        $output->writeln($text);
    }
}
