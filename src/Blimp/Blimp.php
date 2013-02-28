<?php


namespace Blimp;

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

    public function push(PushNotification $notification){



        $response = $this->client->getCommand('push/ios')->execute();

    }





}