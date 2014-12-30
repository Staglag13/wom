<?php

namespace Staglag13\WomTestBundle\Tests\Command;

use Staglag13\WomTestBundle\Command\MusicmozCommand;
use Staglag13\WomTestBundle\Model\Constants;
use Symfony\Component\Console\Tester\CommandTester;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;


/**
 * unit test
 *
 * @package Staglag13\WomTestBundle
 * @author  Staglag13 <Staglag13@users.noreply.github.com>
 */
class MusicmozCommandTest extends KernelTestCase
{

    /**
     * Tests command
     *
     * @return null
     */
    public function testExecute()
    {
        $kernel = $this->createKernel();
        $kernel->boot();

        $application = new Application($kernel);
        $application->add(new MusicmozCommand());

        $command = $application->find('musicmoz:run');
        $commandTester = new CommandTester($command);
        $commandTester->execute(array());

        $this->assertStringStartsWith('created', $commandTester->getDisplay());

        $this->assertFileExists(Constants::XML_TARGET_PATH.Constants::XML_TARGET_NAME);
    }
}
