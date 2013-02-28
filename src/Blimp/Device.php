<?php


namespace Blimp;

class Device {

    const TYPE_IOS = 'ios';
    const TYPE_ANDROID = 'android';


    /** @var string */
    private $type;

    private $token;

    /**
     * @param $type
     * @return Device
     */
    public static function create($type){
        $instance = new static();

        return $instance->setType($type);
    }

    /**
     * @param $type
     * @return Device
     */
    public function setType($type) {
        $this->type = $type;
        return $this;
    }

    /**
     * @return string
     */
    public function getType() {
        return $this->type;
    }

    public function setToken($token) {
        $this->token = $token;
        return $this;
    }

    public function getToken(){
        return $this->token;
    }

}