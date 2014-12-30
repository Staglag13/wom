<?php

namespace Staglag13\WomTestBundle\Model\Client;

/**
 * An interface description for ClientAdapter classes.
 *
 * @package Staglag13\WomTestBundle
 * @author  Staglag13 <Staglag13@users.noreply.github.com>
 */
interface ClientAdapterInterface
{
    /**
     * Connect to resource
     *
     * @param string $host
     * @param int $port
     * @param boolean $secure
     */
    public function connect($host, $port = 80, $secure = false);

    /**
     * Send request
     *
     * @param string $url
     * @param string $method
     */
    public function write($url, $method);

    /**
     * Read response
     *
     * @return string
     */
    public function read();

    /**
     * Close resource
     */
    public function close();
}
