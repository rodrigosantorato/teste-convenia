<?php

namespace App\Http\Controllers;

use App\Company;
use App\Transformers\CompanyTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CompaniesController extends ApiController
{
    protected $companyTransformer;

    public function __construct(CompanyTransformer $companyTransformer)
    {
        $this->companyTransformer = $companyTransformer;
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), CompanyRules(), CompanyMessages());

        if ($validator->fails()) {
            return $this->respondBadRequest($validator->errors());
        }

        $company = Company::create($validator->validated());

        return $this->respondCreated([
            'Company' => $this->companyTransformer->transform($company)
        ]);
    }
}
