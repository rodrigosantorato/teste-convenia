<?php

namespace App\Http\Controllers;

use App\Company;
use App\Transformers\CompanyTransformer;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;

class CompaniesController extends ApiController
{
    protected $companyTransformer;

    function __construct(CompanyTransformer $companyTransformer)
    {
        $this->companyTransformer = $companyTransformer;
    }

    public function index()
    {
        $companies = Company::all();
        return Response::json([
            'data' => $this->companyTransformer->transformCollection($companies->all())
        ]);
    }

    public function show($id)
    {
        $company = Company::find($id);

        if (!$company)
        {
            return $this->respondNotFound('Não achei essa Empresa...');
        }

        return $this->respond([
            'Company Info' => $this->companyTransformer->transform($company)
        ]);
    }

}
