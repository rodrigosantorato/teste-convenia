<?php

namespace App\Http\Controllers;

use App\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ApiTokenController extends ApiController
{
    public function update(Company $company)
    {
        $token = Str::random(80);
        $company->forceFill([
            'api_token' => hash('sha256', $token)
        ])->save();

        return $this->respond(['token' => $token]);
    }
}
