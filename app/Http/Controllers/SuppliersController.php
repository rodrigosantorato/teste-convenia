<?php

namespace App\Http\Controllers;

use App\Company;
use App\Supplier;
use App\Transformers\SupplierTransformer;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SuppliersController extends ApiController
{
    protected $supplierTransformer;

    function __construct(SupplierTransformer $supplierTransformer)
    {
        $this->supplierTransformer = $supplierTransformer;
    }

    public function index($id)
    {
        $supplier = Company::find($id)->suppliers()->get()->toArray();

        if (!$supplier)
        {
            return $this->respondNotFound('Não achei esse Fornecedor...');
        }
        return $this->respond([
            'Suppliers' => $this->supplierTransformer->transformCollection($supplier)
        ]);
    }

    public function show($id)
    {
        $supplier = Company::find($id)->suppliers()->get()->toArray();

        if (!$supplier)
        {
            return $this->respondNotFound('Não achei esse Fornecedor :(');
        }
        return $this->respond([
            'Suppliers' => $this->supplierTransformer->transformCollection($supplier)
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), supplierRules(), supplierMessages());

        if ($validator->fails()) {
            return $this->respondBadRequest($validator->errors());
        }

        Supplier::create($validator->validated());


        return $this->respondCreated('Empresa cadastrada com sucesso');
    }
}
