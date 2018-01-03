<?php

namespace Shared\Request;
use Shared\Request\RequestValidator;
use Shared\Common\Common;

class RequestObject extends RequestValidator {

    protected static $request;

    protected static $requestVariables = array();

    protected static $allowedParameters = array();

    public static function validateRequest($request) {
        static::$request = $request;
        static::loadVariables();
        static::validate();
    }

    public static function loadVariables() {
        foreach (static::$allowedParameters as $input => $validators) {
            $value = static::$request->input($input);
            if (!empty($value)) {
                static::$requestVariables[$input] = $value;
            }
        }
    }
}
 
