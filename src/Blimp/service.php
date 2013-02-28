<?php

return array(
    'name' => 'Blimp',
    'description' => 'A library for interfacing with the UrbanAirship API',
    'operations' => array(
        'register' => array(
            'httpMethod' => 'PUT',
            'uri' => 'device_tokens/{device}',
            'summary' => 'Registers a device token as active',
            'parameters' => array(
                'device' => array(
                    'location' => 'uri',
                    'type' => 'string',
                    'required' => true,
                    'description' => 'The device token to register'
                ),
                'alias' => array(
                    'required' => false,
                    'location' => 'json',
                    'type' => 'string',
                    'description' => 'An alias to associate with this device'
                ),
                'tags' => array(
                    'required' => false,
                    'location' => 'json',
                    'type' => 'array',
                    'description' => 'A list of tags to associate with this device'
                ),
                'badge' => array(
                    'required' => false,
                    'location' => 'json',
                    'type' => 'number',
                    'description' => 'A number to display on the application icon'
                ),
                'quiettime' => array(
                    'required' => false,
                    'location' => 'json',
                    'type' => 'array',
                    'description' => 'A hash of the start and end of the quiet time for this device'
                ),
                'tz' => array(
                    'required' => false,
                    'location' => 'json',
                    'type' => 'string',
                    'description' => 'The timezone the quiettime is located within'
                )
            )
        ),
        'info' => array(
            'httpMethod' => 'GET',
            'uri' => 'device_tokens/{device}/',
            'parameters' => array(
                'device' => array(
                    'location' => 'uri',
                    'type' => 'string',
                    'required' => true,
                    'description' => 'The device token to get info on'
                )
            )
        ),
        'delete' => array(
            'httpMethod' => 'DELETE',
            'uri' => 'device_tokens/{device}/',
            'parameters' => array(
                'device' => array(
                    'location' => 'uri',
                    'type' => 'string',
                    'required' => true,
                    'description' => 'The device token to delete'
                )
            )
        ),
        'push' => array(
            'httpMethod' => 'POST',
            'uri' => 'push/',
            'parameters' => array(
                'alert' => array(
                    'required' => true,
                    'type' => 'string',
                    'description' => 'The text to display for the notification'
                ),
                'custom_data' => array(
                    'required' => false,
                    'type' => 'array',
                    'description' => 'A hash of custom data to send with the notification'
                ),
                'device_tokens' => array(
                    'type' => 'array',
                    'required' => false,
                    'description' => 'An array of device tokens to send to'
                ),
                'aliases' => array(
                    'type' => 'array',
                    'required' => false,
                    'description' => 'An array of device aliases to send to'
                ),
                'tags' => array(
                    'type' => 'array',
                    'required' => false,
                    'description' => 'An array of device tags to send to'
                ),
                'schedule_for' => array(
                    'type' => 'array',
                    'required' => false,
                    'description' => 'An array of device tokens to send to'
                ),
                'exclude_tokens' => array(
                    'type' => 'array',
                    'required' => false,
                    'description' => 'An array of tokens to exclude sending to'
                )
            )
        ),
        'push/ios' => array(
            'extends' => 'push',
            'class' => '\\Blimp\\Command\\Push\\IOSPushCommand',
            'parameters' => array(
                'badge' => array(
                    'required' => false,
                    'type' => array('number', 'string'),
                    'description' => 'A badge number to display on the app icon (iOS only)'
                ),
                'sound' => array(
                    'required' => false,
                    'type' => 'string',
                    'description' => 'A sound to play when the notification is delivered (iOS only)'
                )
            )
        ),
        'push/android' => array(
            'extends' => 'push',
            'class' => '\\Blimp\\Command\\Push\\AndroidPushCommand'
        )
    )
);