<?php

namespace Staglag13\WomTestBundle\Model\Client;

use Symfony\Component\Config\Definition\Exception\Exception;

/**
 * Client Factory
 *
 * @package Staglag13\WomTestBundle
 * @author  Staglag13 <Staglag13@users.noreply.github.com>
 */
class ClientFactory
{

    /**
     * Get client by type
     *
     * @param  string $type client type [REST]
     *
     * @return RestClient
     * @throws \Symfony\Component\Config\Definition\Exception\Exception
     */
    public static function getClient ($type)
    {
        switch (strtolower($type)) {
            case 'rest':
                return new RestClient();
                break;
            default:
                throw new Exception('Unknown client type ['.__METHOD__.']');
        }
    }
}
