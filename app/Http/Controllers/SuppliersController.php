<?php

namespace App\Http\Controllers;

use App\User;
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

    public function index(User $company)
    {
        $suppliers = $company->suppliers()->get()->toArray();

        if (!$suppliers)
        {
            return $this->respondNotFound('Não achei nenhum Fornecedor...');
        }
        return $this->respond([
            'Suppliers' => $this->supplierTransformer->transformCollection($suppliers)
        ]);
    }

    public function show(User $company, Supplier $supplier)
    {
        if (!$supplier)
        {
            return $this->respondNotFound('Não achei esse Fornecedor...');
        }
        return $this->respond([
            'Suppliers' => $this->supplierTransformer->transform($supplier)
        ]);
    }

    public function store(Request $request, User $company)
    {
        $validator = Validator::make($request->all(), supplierRules(), supplierMessages());

        if ($validator->fails()) {
            return $this->respondBadRequest($validator->errors());
        }

        $supplier = $company->suppliers()->create($validator->validated());

        return $this->respondCreated([
            'Supplier' => $this->supplierTransformer->transform($supplier)
        ]);
    }

    public function update(Request $request, User $company, Supplier $supplier)
    {
        $validator = Validator::make($request->all(), supplierRules(), supplierMessages());
        if ($validator->fails()) {
            return $this->respondBadRequest($validator->errors());
        }

        $supplier->update($validator->validated());

        return $this->respondNoContent();
    }

    public function destroy(User $company, Supplier $supplier)
    {
        $supplier->delete();

        return $this->respondNoContent();
    }
}
