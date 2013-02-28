<?php


namespace Blimp\Command\Push;

use Blimp\Command\PushCommand,
    Guzzle\Http\Message\Request;

class IOSPushCommand extends PushCommand {


    protected function getPayload() {

        $payload = array(
            'aps' => array(
                'alert' => $this->data['alert'],
            )
        );

        if(isset($this->data['badge']))
            $payload['aps']['badge'] = $this->data['badge'];

        if(isset($this->data['sound']))
            $payload['aps']['sound'] = $this->data['sound'];


        if(isset($this->data['custom_data']) && is_array($this->data['custom_data']))
            $payload = array_merge($this->data['custom_data'], $payload);

        return $payload;
    }

}