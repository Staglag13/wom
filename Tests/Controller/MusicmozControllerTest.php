<?php

namespace Staglag13\WomTestBundle\Tests\Controller;

use Staglag13\WomTestBundle\Model\Constants;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * unit test
 *
 * @package Staglag13\WomTestBundle
 * @author  Staglag13 <Staglag13@users.noreply.github.com>
 */
class MusicmozControllerTest extends WebTestCase
{
    /**
     * Tests frontend
     *
     * @return null
     */
    public function testController()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/musicmoz');
        $this->assertTrue($client->getResponse()->isSuccessful());
        $this->assertGreaterThan(0, $crawler->filter('html:contains("Worldofmusic Application")')->count());
    }

    /**
     * Tests download
     *
     * @return null
     */
    public function testResponse()
    {
        $client = static::createClient();
        $client->request('GET', '/musicmoz/download');
        $response = $client->getResponse();
        $this->assertTrue($response->isSuccessful());
        $this->assertTrue(
            $response->headers->contains(
                'Content-Type',
                'application/octet-stream'
            )
        );
        $this->assertEquals('UTF-8', $response->getCharset());
        $this->assertNotEmpty($response->getContent());
        /**
         * Check for valid XML
         */
        $xmlData = $response->getContent();
        libxml_use_internal_errors( true );
        $doc = new \DOMDocument('1.0', 'utf-8');
        $doc->loadXML($xmlData);
        $xmlErrors = libxml_get_errors();
        $this->assertEquals(0, count($xmlErrors));

        $this->assertFileExists(Constants::XML_TARGET_NAME);
    }
}
