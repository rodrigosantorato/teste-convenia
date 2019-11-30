<?php

namespace App\Http\Middleware;

use App\Http\Controllers\ApiController;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Contracts\Auth\Factory as Auth;

class Authenticate extends Middleware
{
    protected $apiController;

    public function __construct(Auth $auth, ApiController $apiController)
    {
        parent::__construct($auth);

        $this->apiController = $apiController;
    }

    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    protected function redirectTo($request)
    {
        return $this->apiController->respondUnauthorized('Não autorizado');
    }
}
