<?php

namespace Staglag13\WomTestBundle\Tests\Model;

use Staglag13\WomTestBundle\Model\Release;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * unit test
 *
 * @package Staglag13\WomTestBundle
 * @author  Staglag13 <Staglag13@users.noreply.github.com>
 */
class ReleaseTest extends WebTestCase
{

    /**
     * Test Getter/Setter
     *
     * @return null
     */
    public function testSetDiscCount()
    {
        $release = new Release();
        $release->setDiscCount(10);
        $this->assertEquals(10, $release->getDiscCount());
    }
}