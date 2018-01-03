<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Shared\Request\CreateUser;
use Shared\Request\Exception\ValidationException;
use Shared\Models\User;

class UsersController extends Controller {
    /**
     * Handle a new create user request.
     *
     * @return void
     **/
    public function createUser(Request $request) {
        try {
            $requestData = CreateUser::validateRequest($request);
        } catch (ValidationException $e) {
            return $this->createErrorResponse($e);
        }
    }

    /**
     * Handle a get user request.
     *
     * @return void
     **/
    public function fetchUser(Request $request) {
        print "heyooooooooo";
die();
        $requestData = FetchUser::validateRequest($request);
    }


}
