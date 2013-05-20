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
            'class' => '\\Blimp\\Command\\PushCommand',
            'httpMethod' => 'POST',
            'uri' => 'push/',
            'parameters' => array(
                'alert' => array(
                    'location' => 'json',
                    'type' => 'string',
                    'required' => true,
                    'description' => 'The alert message to display on the notification.'
                ),
                'metadata' => array(
                    'location' => 'json',
                    'type' => 'array',
                    'required' => false,
                    'description' => 'Any additional custom metadata to send with the notification'
                ),
                'device_tokens' => array(
                    'location' => 'json',
                    'type' => 'array',
                    'required' => false,
                    'description' => 'An array of device tokens to send to (iOS devices)',
                    'filters' => array(
                        array(
                            'method' => '\\Blimp\\Filters\\TokenArrayFilter::deviceTokens',
                            'args' => array('@value', '@api')
                        )
                    )
                ),
                'apids' => array(
                    'location' => 'json',
                    'type' => 'array',
                    'required' => false,
                    'description' => 'An array of APIDs to send to (Android and WP)',
                    'filters' => array(
                        array(
                            'method' => '\\Blimp\\Filters\\TokenArrayFilter::apids',
                            'args' => array('@value', '@api')
                        )
                    )
                ),
                'device_pins' => array(
                    'location' => 'json',
                    'type' => 'array',
                    'required' => false,
                    'description' => 'An array of device pins to send to (Blackberry)',
                    'filters' => array(
                        array(
                            'method' => '\\Blimp\\Filters\\TokenArrayFilter::devicePins',
                            'args' => array('@value', '@api')
                        )
                    )
                ),
                'tags' => array(
                    'location' => 'json',
                    'type' => 'array',
                    'required' => false,
                    'description' => 'An array of device tags to send to',
                    'filters' => array(
                        array(
                            'method' => '\\Blimp\\Filters\\TokenArrayFilter::tagsOrAliases',
                            'args' => array('@value', '@api')
                        )
                    )
                ),
                'aliases' => array(
                    'location' => 'json',
                    'type' => 'array',
                    'required' => false,
                    'description' => 'An array of device aliases to send to',
                    'filters' => array(
                        array(
                            'method' => '\\Blimp\\Filters\\TokenArrayFilter::tagsOrAliases',
                            'args' => array('@value', '@api')
                        )
                    )
                ),
                'exclude_tokens' => array(
                    'location' => 'json',
                    'type' => 'array',
                    'required' => false,
                    'description' => 'An array of tokens to exclude sending to',
                    'filters' => array(
                        array(
                            'method' => '\\Blimp\\Filters\\TokenArrayFilter::deviceTokens',
                            'args' => array('@value', '@api')
                        )
                    )
                ),
                'aps' => array(
                    'location' => 'json',
                    'required' => false,
                    'type' => 'object',
                    'description' => 'Dedicated payload for Apple Push Service parameters',
                    'properties' => array(
                        'badge' => array(
                            'location' => 'json',
                            'required' => false,
                            'type' => array('number', 'string'),
                            'description' => 'A badge number to display on the app icon (iOS only)'
                        ),
                        'sound' => array(
                            'location' => 'json',
                            'required' => false,
                            'type' => 'string',
                            'description' => 'A sound to play when the notification is delivered (iOS only)'
                        ),
                    )
                ),
                'android' => array(
                    'location' => 'json',
                    'required' => false,
                    'type' => 'array',
                    'description' => 'Dedicated payload for Android Devices'
                ),
                'blackberry' => array(
                    'location' => 'json',
                    'required' => false,
                    'type' => 'array',
                    'description' => 'Dedicated payload for Blackberry devices'
                ),
                'schedule_for' => array(
                    'location' => 'json',
                    'type' => 'array',
                    'required' => false,
                    'description' => 'An array of device tokens to send to'
                ),
            )
        )
    )
);