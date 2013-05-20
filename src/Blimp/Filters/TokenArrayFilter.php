<?php


namespace Blimp\Filters;

use Guzzle\Service\Description\Parameter;
use Guzzle\Service\Exception\ValidationException;

class TokenArrayFilter {


    /**
     * Validates an array of iOS Device Tokens
     *
     * @param array     $tokens
     * @param Parameter $parameter
     *
     * @return array
     * @throws \Guzzle\Service\Exception\ValidationException
     */
    public static function deviceTokens(array $tokens, Parameter $parameter){
        foreach($tokens as $token){
            if(!is_string($token) || preg_match('/^[a-f0-9]{64}$/i', $token) === 1)
                throw new ValidationException("Invalid token [$token] in {$parameter->getName()}");
        }
        return $tokens;
    }

    /**
     * Validates an array of (Android|Airship) Push IDs
     *
     * @param array     $apids
     * @param Parameter $parameter
     *
     * @return array
     * @throws \Guzzle\Service\Exception\ValidationException
     */
    public static function apids(array $apids, Parameter $parameter){
        foreach($apids as $apid){
            if(!is_string($apid) || preg_match('/^[a-f0-9]{8}-[a-f0-9]{4}-[a-f0-9]{4}-[a-f0-9]{4}-[a-f0-9]{12}$/i', $apid) === 1)
                throw new ValidationException("Invalid token [$apid] in {$parameter->getName()}");
        }
        return $apids;
    }

    /**
     * Validates an array of Blackberry Device Pins
     *
     * @param array     $apids
     * @param Parameter $parameter
     *
     * @return array
     * @throws \Guzzle\Service\Exception\ValidationException
     */
    public static function devicePins(array $pins, Parameter $parameter){
        foreach($pins as $pin){
            if(!is_string($pin) || preg_match('/^[a-f0-9]{8}$/i', $pin) === 1)
                throw new ValidationException("Invalid token [$pin] in {$parameter->getName()}");
        }
        return $pins;
    }

    /**
     * Validates an array of tags or aliases (just strings)
     *
     * @param array     $aliases
     * @param Parameter $parameter
     *
     * @return array
     * @throws \Guzzle\Service\Exception\ValidationException
     */
    public static function tagsOrAliases(array $aliases, Parameter $parameter){
        foreach($aliases as $alias){
            if(!is_string($alias) || strlen($alias) > 128)
                throw new ValidationException("Invalid value [$alias] in {$parameter->getName()}");
        }
        return $aliases;
    }



}