<?php

namespace Staglag13\WomTestBundle\Model\Client;

/**
 * CURL Adapter
 *
 * @package Staglag13\WomTestBundle
 * @author  Staglag13 <Staglag13@users.noreply.github.com>
 */
class ClientAdapterCurl implements ClientAdapterInterface
{

    /** @var resource   curl handle */
    protected $_resource = null;

    /**
     * Connect to resource
     *
     * @param  string $host
     * @param  int $port
     * @param  boolean $secure
     *
     * @return ClientAdapterCurl|null
     */
    public function connect($host, $port = 80, $secure = false)
    {
        return $this->_getResource();
    }

    /**
     * Returns a CURL handle on success
     *
     * @return resource|null
     */
    protected function _getResource()
    {
        if (is_null($this->_resource)) {
            $this->_resource = curl_init();
        }
        return $this->_resource;
    }

    /**
     * Send request
     *
     * @param  string $url
     * @param  string $method
     * @param  string $userAgent
     *
     * @return bool
     */
    public function write($url, $method, $userAgent = '')
    {

        $options = array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_USERAGENT => $userAgent
        );
        if ($method == 'POST') {
            $options[CURLOPT_POST] = true;
        } elseif ($method == 'GET') {
            $options[CURLOPT_HTTPGET] = true;
        }

        return curl_setopt_array($this->_getResource(), $options);
    }

    /**
     * Read response
     *
     * @return string
     */
    public function read()
    {
        return curl_exec($this->_getResource());
    }

    /**
     * Close resource
     *
     * @return ClientAdapterCurl
     */
    public function close()
    {
        curl_close($this->_getResource());
        $this->_resource = null;
        return $this;
    }

    /**
     * Get last error number
     *
     * @return int
     */
    public function getErrno()
    {
        return curl_errno($this->_getResource());
    }

    /**
     * Get string with last error for the current session
     *
     * @return string
     */
    public function getError()
    {
        return curl_error($this->_getResource());
    }

    /**
     * Get information regarding a specific transfer
     *
     * @return mixed
     */
    public function getInfo()
    {
        return curl_getinfo($this->_getResource());
    }
}
