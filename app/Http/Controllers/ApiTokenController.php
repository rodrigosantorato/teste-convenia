<?php

namespace App\Http\Controllers;

use App\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ApiTokenController extends ApiController
{
    public function create(Request $request, Company $company)
    {
        if ($request['email'] !== $company->email || $request['password'] !== $company->password) {
            return $this->respondUnauthorized('Email ou senha inválidos.');
        }
        $token = Str::random(80);
        $company->forceFill([
            'api_token' => $token
        ])->save();
//dd($company);
        return $this->respond(['token' => $token]);
    }
}
