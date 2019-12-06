<?php


namespace App\Services;

use App\Company;
use App\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SuppliersService
{
    protected $validationErrors;
    protected $validated;

    public function validate(Request $request)
    {
        $validator = Validator::make($request->all(), supplierRules(), supplierMessages());
        if ($validator->fails()) {
            $this->validationErrors = $validator->errors();
            return false;
        }
        $this->validated = $validator->validated();
        return true;
    }

    public function validationErrors()
    {
        return $this->validationErrors;
    }

    public function validated()
    {
        return $this->validated;
    }

    public function authenticate(Request $request, Company $company)
    {
//        if ($request['api_token'] !== $company->api_token || $company->api_token == null) {
//            return false;
//        }
        return true;
    }

    public function authenticateSupplier(Request $request, Company $company, Supplier $supplier)
    {
//        if ($request['api_token'] !== $company->api_token || $company->api_token == null
//            || $company->id !== $supplier->company_id) {
//            return false;
//        }
        return true;
    }
}
