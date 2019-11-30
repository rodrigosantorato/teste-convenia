<?php


namespace App\Services;


use App\Company;
use App\Http\Controllers\ApiController;
use App\Supplier;
use Illuminate\Http\Request;

class Authenticator extends ApiController
{
    public function authenticate(Request $request, Company $company)
    {
        if ($request['api_token'] !== $company->api_token || $company->api_token == null) {
            return false;
        }
        return true;
    }

    public function authenticateSupplier(Request $request, Company $company, Supplier $supplier)
    {
        if ($request['api_token'] !== $company->api_token || $company->api_token == null || $company->id !== $supplier->company_id) {
            return false;
        }
        return true;
    }
}
