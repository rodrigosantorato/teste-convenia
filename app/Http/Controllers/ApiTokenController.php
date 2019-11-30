<?php

namespace App\Http\Controllers;

use App\Company;
use Illuminate\Support\Str;

class ApiTokenController extends ApiController
{
    public function create(Company $company)
    {
        $token = Str::random(80);
        $company->forceFill([
            'api_token' => $token
        ])->save();

        return $this->respond(['token' => $token]);
    }
}
