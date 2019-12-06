<?php

namespace App\Http\Controllers;

use App\Company;
use App\Services\SuppliersService;
use App\Supplier;
use App\Transformers\SupplierTransformer;
use Illuminate\Http\Request;

class SuppliersController extends ApiController
{
    protected $supplierTransformer;
    protected $service;

    public function __construct(SupplierTransformer $supplierTransformer, SuppliersService $service)
    {
        $this->supplierTransformer = $supplierTransformer;
        $this->service = $service;
    }

    public function index(Request $request, Company $company)
    {
        if (!$this->service->authenticate($request, $company)) {
            return $this->respondUnauthorized('Usuário não autorizado.');
        }
        if (!$suppliers = $company->suppliers()->get()->toArray()) {
            return $this->respond('');
        }
        return $this->respond([
            'Suppliers' => $this->supplierTransformer->transformCollection($suppliers)
        ]);
    }

    public function total(Request $request, Company $company)
    {
        if (!$this->service->authenticate($request, $company)) {
            return $this->respondUnauthorized('Usuário não autorizado.');
        }
        return $this->respond([
            'Total' => formatCurrency($company->suppliers()->sum('monthly_fee'))
        ]);
    }

    public function show(Request $request, Company $company, Supplier $supplier)
    {
        if (!$this->service->authenticateSupplier($request, $company, $supplier)) {
            return $this->respondUnauthorized('Usuário não autorizado.');
        }
        return $this->respond([
            'Supplier' => $this->supplierTransformer->transform($supplier)
        ]);
    }

    public function store(Request $request, Company $company)
    {
        if (!$this->service->authenticate($request, $company)) {
            return $this->respondUnauthorized('Usuário não autorizado.');
        }
        if (!$this->service->validate($request)) {
            return $this->respondBadRequest($this->service->validationErrors());
        }
        $supplier = $company->suppliers()->create($this->service->validated());

        return $this->respondCreated([
            'Supplier' => $this->supplierTransformer->transform($supplier)
        ]);
    }

    public function update(Request $request, Company $company, Supplier $supplier)
    {
        if (!$this->service->authenticateSupplier($request, $company, $supplier)) {
            return $this->respondUnauthorized('Usuário não autorizado.');
        }
        if (!$this->service->validate($request)) {
            return $this->respondBadRequest($this->service->validationErrors());
        }
        $supplier->update($this->service->validated());

        return $this->respondNoContent();
    }

    public function destroy(Request $request, Company $company, Supplier $supplier)
    {
        if (!$this->service->authenticateSupplier($request, $company, $supplier)) {
            return $this->respondUnauthorized('Usuário não autorizado.');
        }
        $supplier->delete();

        return $this->respondNoContent();
    }
}
