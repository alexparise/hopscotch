<?php

namespace Shared\Response;

class ErrorResponse extends ResponseObject {

    protected $allowedOutputs = array(
        'responseCode' => [self::PARAM_TYPE => self::TYPE_INTEGER, self::PARAM_REQUIRED => true],
        'errorCode' => [self::PARAM_TYPE => self::TYPE_STRING, self::PARAM_REQUIRED => true],
        'errors' => [self::PARAM_TYPE => self::TYPE_STRING, self::PARAM_REQUIRED => true],
  
    }
}

