<?php

namespace Blimp;

use Blimp\Visitors\ApsRequestVisitor;
use Guzzle\Common\Collection,
    Guzzle\Service\Client,
    Guzzle\Service\Description\ServiceDescription,
    Guzzle\Plugin\CurlAuth\CurlAuthPlugin;
use Guzzle\Service\Command\LocationVisitor\VisitorFlyweight;

/**
 * My example web service client
 */
class BlimpClient extends Client
{
    /**
     * Factory method to create a new BlimpClient
     *
     * The following array keys and values are available options:
     * - base_url: Base URL of web service
     * - username: API username
     * - password: API password
     *
     * @param array|Collection $config Configuration data
     *
     * @return self
     */
    public static function factory($config = array())
    {
        $default = array(
            'base_url' => 'https://go.urbanairship.com/api/',
        );
        $required = array('base_url', 'appKey', 'appSecret');
        $config = Collection::fromConfig($config, $default, $required);

        $client = new self($config->get('base_url'), $config);
        // Attach a service description to the client
        $description = ServiceDescription::factory(__DIR__ . '/service.php');
        $client->setDescription($description);

        $client->addSubscriber(new CurlAuthPlugin(
            $config->get('appKey'),
            $config->get('appSecret')
        ));

        return $client;
    }
}