<?php

namespace App\Http\Controllers;

use App\Company;
use App\Supplier;
use App\Transformers\SupplierTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SuppliersController extends ApiController
{
    protected $supplierTransformer;

    function __construct(SupplierTransformer $supplierTransformer)
    {
        $this->supplierTransformer = $supplierTransformer;
    }

    public function index($companyId)
    {
        $suppliers = Company::find($companyId)->suppliers()->get()->toArray();

        if (!$suppliers)
        {
            return $this->respondNotFound('Não achei nenhum Fornecedor...');
        }
        return $this->respond([
            'Suppliers' => $this->supplierTransformer->transformCollection($suppliers)
        ]);
    }

    public function show(Request $request, Company $company, Supplier $supplier)
    {
        if ($request['api_token'] != $company->api_token) {
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
        $validator = Validator::make($request->all(), supplierRules(), supplierMessages());
        if ($validator->fails()) {
            return $this->respondBadRequest($validator->errors());
        }

        $supplier->update($validator->validated());

        return $this->respondNoContent();
    }

    public function destroy(Company $company, Supplier $supplier)
    {
        $supplier->delete();

        return $this->respondNoContent();
    }
}
