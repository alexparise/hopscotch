<?php

namespace Shared\Request\Exception;

class ValidationException extends \Exception {

    protected $code = 'VAL-1000';

    protected $message = 'There was an error processing your request.\n\n';

    public function __construct($message) {
        $this->message = $this->message . $message;
    }
}
