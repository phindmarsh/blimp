<?php

namespace Blimp;

class PushNotification {

    /**
     * A list of devices to send this notification to
     *
     * @var array
     */
    private $devices = array();

    /**
     * The string to display on the device
     *
     * @var string
     */
    private $alert;

    /**
     * @var array
     */
    private $payload = array();


    /**
     * Initialise a new notification
     *
     * @return PushNotification
     */
    public static function init(){
        return new static();
    }

    /**
     * @param Device $device
     * @return PushNotification
     */
    public function addDevice(Device $device){
        return $this->addDevices(array($device));
    }

    /**
     * @param Device[] $devices
     * @return PushNotification
     */
    public function addDevices(array $devices){
        foreach($devices as $device){
            $type = $device->getType();
            if(!isset($this->devices[$type]))
                $this->devices[$type] = array();

            if(!in_array($device, $this->devices[$type]))
                $this->devices[$type][] = $device;
        }

        return $this;
    }

    /**
     * @param $alert
     * @return PushNotification
     */
    public function setAlert($alert) {
        $this->payload['alert'] = $alert;
        return $this;
    }


    public function setCustomData($data){
        $this->payload['custom_data'] = $data;
        return $this;
    }

    public function setBadge($badge){
        $this->payload['badge'] = $badge;
        return $this;
    }

    public function send(Blimp $blimp) {

        $sent_pushes = array();

        foreach($this->devices as $type => $devices){
            $command = "push/$type";
            $arguments= $this->payload;
            $arguments['device_tokens'] = array();
            foreach($devices as $device){
                /** @var Device $device */
                $arguments['device_tokens'][] = $device->getToken();
            }

            $response = $blimp->client->getCommand($command, $arguments)->execute();
            if(is_array($response) && isset($response['push_id'])){
                $sent_pushes[] = $response['push_id'];
            }
        }

        return $sent_pushes;

    }




}