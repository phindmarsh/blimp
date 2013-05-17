<?php


namespace Blimp;

use Guzzle\Http\Message\Response;
use InvalidArgumentException;

class Blimp {


    /**
     * Wrapper to generate a new Blimp instance.
     *
     * @param array $config
     * @return Blimp
     */
    public static function takeoff(array $config){
        return new static($config);
    }

    /**
     * Build a new Blimp instance
     *
     * @param array $config
     * @throws \InvalidArgumentException
     */
    public function __construct(array $config){
        if(!isset($config['appKey'], $config['appSecret'], $config['appMasterSecret']))
            throw new InvalidArgumentException("Blimp requires 'appKey', 'appSecret' and 'appMasterSecret'");

        $this->client = BlimpClient::factory($config);
    }

    /**
     * @param $device_token
     *
     * @return array
     */
    public function info($device_token){
        return $this->client->getCommand('info', array(
            'device' => $device_token
        ))->execute();

    }

    /**
     * @param $device_token
     *
     * @return boolean
     */
    public function delete($device_token){
        $response = $this->client->getCommand('delete', array(
            'device' => $device_token
        ))->execute();

        return $response instanceof Response && $response->getStatusCode() === 204;

    }

}