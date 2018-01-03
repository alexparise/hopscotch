<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Shared\Response\ErrorResponse;

class Controller extends BaseController
{

    public function createErrorResponse($exception) {
        $responseArray = array(
            'responseCode' => 404,
            'errorCode' => $exception->getCode(),
            'message' => $exception->getMessage()
        );

        $responseObject = new ErrorResponse($responseArray);
        $responseObject->outputJson();
    }
}
