<?php

namespace App\Http\Controllers;

use App\Company;
use App\Transformers\CompanyTransformer;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;

class CompaniesController extends ApiController
{
    protected $userTransformer;

    function __construct(CompanyTransformer $userTransformer)
    {
        $this->userTransformer = $userTransformer;
    }

    public function index()
    {
        $companies = Company::all();
        return Response::json([
            'data' => $this->userTransformer->transformCollection($companies->all())
        ]);
    }

    public function show($id)
    {
        $user = Company::find($id);

        if (!$user)
        {
            return $this->respondNotFound('Não achei essa Empresa :(');
        }

        return $this->respond([
            'data' => $this->userTransformer->transform($user)
        ]);
    }

}
