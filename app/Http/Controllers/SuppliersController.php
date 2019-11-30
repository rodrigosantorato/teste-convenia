<?php

namespace App\Http\Controllers;

use App\Company;
use App\Supplier;
use App\Transformers\SupplierTransformer;
use App\Transformers\TotalTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SuppliersController extends ApiController
{
    protected $supplierTransformer;

    protected $totalTransformer;

    function __construct(SupplierTransformer $supplierTransformer, TotalTransformer $totalTransformer)
    {
        $this->supplierTransformer = $supplierTransformer;
        $this->totalTransformer = $totalTransformer;
    }

    public function index(Request $request, Company $company)
    {
        if ($request['api_token'] !== $company->api_token || $company->api_token == null) {
            return $this->respondUnauthorized('Você não tá autorizado, bebê.');
        }
        $suppliers = $company->suppliers()->get()->toArray();

        if (!$suppliers)
        {
            return $this->respondNotFound('Não achei nenhum Fornecedor...');
        }
        return $this->respond([
            'Suppliers' => $this->supplierTransformer->transformCollection($suppliers)
        ]);
    }

    public function total(Request $request, Company $company)
    {
        if ($request['api_token'] !== $company->api_token || $company->api_token == null) {
            return $this->respondUnauthorized('Você não tá autorizado, bebê.');
        }
        $total = 0;
        foreach ($company->suppliers()->get() as $supplier) {
            $total = $supplier->monthly_fee + $total;
        }

        if (!$total)
        {
            return $this->respondNotFound('Não achei nenhum Fornecedor...');
        }
        return $this->respond([
            'Total' => $this->totalTransformer->transform($total)
        ]);
    }

    public function show(Request $request, Company $company, Supplier $supplier)
    {
        if ($request['api_token'] !== $company->api_token || $company->api_token == null || $company->id !== $supplier->company_id) {
            return $this->respondUnauthorized('Você não tá autorizado, bebê.');
        }

        if (!$supplier)
        {
            return $this->respondNotFound('Não achei esse Fornecedor...');
        }

        return $this->respond([
            'Suppliers' => $this->supplierTransformer->transform($supplier)
        ]);
    }

    public function store(Request $request, Company $company)
    {
        if ($request['api_token'] !== $company->api_token || $company->api_token == null) {
            return $this->respondUnauthorized('Você não tá autorizado, bebê.');
        }
        $validator = Validator::make($request->all(), supplierRules(), supplierMessages());

        if ($validator->fails()) {
            return $this->respondBadRequest($validator->errors());
        }
        if ($request['api_token'] != $company->api_token) {
            return $this->respondUnauthorized('Você não tá autorizado, bebê.');
        }

        $supplier = Company::findOrFail($company->id)->suppliers()->create($validator->validated());

        return $this->respondCreated([
            'Supplier' => $this->supplierTransformer->transform($supplier)
        ]);
    }

    public function update(Request $request, Company $company, Supplier $supplier)
    {
        if ($request['api_token'] !== $company->api_token || $company->api_token == null || $company->id !== $supplier->company_id) {
            return $this->respondUnauthorized('Você não tá autorizado, bebê.');
        }
        $validator = Validator::make($request->all(), supplierRules(), supplierMessages());
        if ($validator->fails()) {
            return $this->respondBadRequest($validator->errors());
        }

        $supplier->update($validator->validated());

        return $this->respondNoContent();
    }

    public function destroy(Request $request, Company $company, Supplier $supplier)
    {
        if ($request['api_token'] !== $company->api_token || $company->api_token == null || $company->id !== $supplier->company_id) {
            return $this->respondUnauthorized('Você não tá autorizado, bebê.');
        }
        $supplier->delete();

        return $this->respondNoContent();
    }
}
