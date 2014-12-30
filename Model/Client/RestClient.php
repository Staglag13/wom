<?php

namespace Staglag13\WomTestBundle\Model\Client;

use Symfony\Component\Config\Definition\Exception\Exception;

/**
 * REST Client
 *
 * @package Staglag13\WomTestBundle
 * @author  Staglag13 <Staglag13@users.noreply.github.com>
 */
class RestClient extends ClientAdapterCurl
{

    /**
     * Send the HTTP request and return the response
     *
     * @param  string $url
     * @param  string $method
     * @param  string $userAgent
     *
     * @return string
     * @throws \Symfony\Component\Config\Definition\Exception\Exception
     */
    public function request($url, $method, $userAgent = '')
    {

        if ($this->write($url, $method, $userAgent)) {

            $response = $this->read();

            if ($this->getErrno()) {
                throw new Exception ('cURL error ('.$this->getErrno().'): '.$this->getError());
            }

            $this->close();
            return $response;
        } else {
            throw new Exception ('cURL error: unknown write error ['.__METHOD__.']');
        }
    }
}
