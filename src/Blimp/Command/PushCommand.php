<?php


namespace Blimp\Command;

use Guzzle\Service\Command\OperationCommand,
    Guzzle\Service\Exception\ValidationException,
    Guzzle\Http\Message\Request;

abstract class PushCommand extends OperationCommand {

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

        if ($this->jsonContentType && !$this->request->hasHeader('Content-Type')) {
            $this->request->setHeader('Content-Type', $this->jsonContentType);
        }

        $payload = $this->assemblePayload();
        $this->request->setBody(json_encode($payload));
    }

    private function assemblePayload(){
        $payload = array();
        foreach(self::$destinations as $destination){
            if(isset($this->data[$destination])
                && is_array($this->data[$destination])
                && !empty($this->data[$destination])){

                $payload[$destination] = $this->data[$destination];
            }
        }
        if(empty($payload)){
            $via = implode(', ', self::$destinations);
            throw new ValidationException("Push Command requires at least one destination be set (via [$via])");
        }

        $payload = array_merge($this->getPayload(), $payload);
        return $payload;
    }

    abstract protected function getPayload();

}