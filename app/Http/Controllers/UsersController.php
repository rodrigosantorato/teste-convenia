<?php

namespace App\Http\Controllers;

use App\User;
use App\Transformers\UserTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UsersController extends ApiController
{
    protected $userTransformer;

    function __construct(UserTransformer $userTransformer)
    {
        $this->userTransformer = $userTransformer;
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), CompanyRules(), CompanyMessages());

        if ($validator->fails()) {
            return $this->respondBadRequest($validator->errors());
        }

        $user = User::create($validator->validated());

        return $this->respondCreated([
            'Company' => $this->userTransformer->transform($user)
        ]);
    }
}
