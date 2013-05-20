<?php


namespace Blimp\Command;

use Guzzle\Service\Command\OperationCommand,
    Guzzle\Service\Exception\ValidationException,
    Guzzle\Http\Message\Request;

class PushCommand extends OperationCommand {

    private $jsonContentType = 'application/json';

    private static $destinations = array('device_tokens', 'tags', 'aliases');

    /**
     * Create the request object that will carry out the command
     */
    protected function build() {
        parent::build();

        // This request needs the master secret
        $user = $this->getClient()->getConfig()->get('appKey');
        $pass = $this->getClient()->getConfig()->get('appMasterSecret');
        $this->request->setAuth($user, $pass);

        if (!$this->request->hasHeader('Content-Type')) {
            $this->request->setHeader('Content-Type', $this->jsonContentType);
        }

        $payload = $this->assemblePayload();
        $this->request->setBody(json_encode($payload));
    }

    private function assemblePayload(){
        // check we have at least one valid destination to push to
        $destinations = array();
        foreach(self::$destinations as $destination){
            if(isset($this->data[$destination])
                && is_array($this->data[$destination])
                && !empty($this->data[$destination])){

                $destinations[$destination] = $this->data[$destination];
            }
        }
        if(empty($destinations)){
            $via = implode(', ', self::$destinations);
            throw new ValidationException("Push Command requires at least one destination be set (via [$via])");
        }

        // move the alert into the respective payloads (aps, android and blackberry)
        // make each platform payload if they don't exist
        foreach(array('aps', 'android', 'blackberry') as $platform){
            if(!isset($this->data['aps']) || !is_array($this->data['aps']))
                $this->data['aps'] = array();
        }

        $this->data['aps']['alert'] = $this->data['alert'];
        $this->data['android']['alert'] = $this->data['alert'];

        unset($this->data['alert']);

        // move the metadata data into the android payload directly
        if(isset($this->data['metadata'])){
            $this->data['android']['extra'] = $this->data['metadata'];
        }

        return $this->data;
    }

}