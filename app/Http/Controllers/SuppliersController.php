<?php

namespace App\Http\Controllers;

use App\Company;
use App\Services\Authenticator;
use App\Services\SupplierValidator;
use App\Supplier;
use App\Transformers\SupplierTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SuppliersController extends ApiController
{
    protected $supplierTransformer;
    protected $authenticator;
    protected $supplierValidator;

    function __construct(SupplierTransformer $supplierTransformer, Authenticator $authenticator,
                         SupplierValidator $supplierValidator)
    {
        $this->authenticator = $authenticator;
        $this->supplierTransformer = $supplierTransformer;
        $this->supplierValidator = $supplierValidator;
    }

    public function index(Request $request, Company $company)
    {
        if(!$this->authenticator->authenticate($request, $company)) {
            return $this->respondUnauthorized('Você não tá autorizado, bebê.');
        }
        if (!$suppliers = $company->suppliers()->get()->toArray())
        {
            return $this->respondNotFound('Não achei nenhum Fornecedor...');
        }
        return $this->respond([
            'Suppliers' => $this->supplierTransformer->transformCollection($suppliers)
        ]);
    }

    public function total(Request $request, Company $company)
    {
        if(!$this->authenticator->authenticate($request, $company)) {
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
            'Total' => formatCurrency($total)
        ]);
    }

    public function show(Request $request, Company $company, Supplier $supplier)
    {
        if(!$this->authenticator->authenticateSupplier($request, $company, $supplier)) {
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
        if(!$this->authenticator->authenticate($request, $company)) {
            return $this->respondUnauthorized('Você não tá autorizado, bebê.');
        }
        if (!$this->supplierValidator->validate($request)) {
            return $this->respondBadRequest($this->supplierValidator->errors());
        }
        $supplier = $company->suppliers()->create($this->supplierValidator->validated());

        return $this->respondCreated([
            'Supplier' => $this->supplierTransformer->transform($supplier)
        ]);
    }

    public function update(Request $request, Company $company, Supplier $supplier)
    {
        if(!$this->authenticator->authenticateSupplier($request, $company, $supplier)) {
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
        if(!$this->authenticator->authenticateSupplier($request, $company, $supplier)) {
            return $this->respondUnauthorized('Você não tá autorizado, bebê.');
        }
        $supplier->delete();

        return $this->respondNoContent();
    }
}
