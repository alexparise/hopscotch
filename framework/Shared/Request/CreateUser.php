<?php

namespace Shared\Request;
use Shared\Request\RequestObject;

class CreateUser extends RequestObject {

    /** @param array $allowedParameters */
    protected static $allowedParameters = [
        'firstName' => [self::PARAM_TYPE => self::TYPE_STRING, self::PARAM_REQUIRED => true, self::PARAM_MAXLENGTH => 15],
        'lastName' => [self::PARAM_TYPE => self::TYPE_STRING, self::PARAM_REQUIRED => true, self::PARAM_MAXLENGTH => 25],
        'username' => [self::PARAM_TYPE => self::TYPE_STRING, self::PARAM_REQUIRED => true, self::PARAM_MAXLENGTH => 25],
        'email' => [self::PARAM_TYPE => self::TYPE_EMAIL, self::PARAM_REQUIRED => true, self::PARAM_MAXLENGTH => 25],
        'password' => [self::PARAM_TYPE => self::TYPE_PASSWORD, self::PARAM_REQUIRED => true, self::PARAM_MINLENGTH => 8, self::PARAM_MAXLENGTH => 255],
        'confirmPassword' => [self::PARAM_TYPE => self::TYPE_PASSWORD, self::PARAM_REQUIRED => true, self::PARAM_MINLENGTH => 8, self::PARAM_MAXLENGTH => 255, self::PARAM_MATCH => 'password']
    ];
}
 
