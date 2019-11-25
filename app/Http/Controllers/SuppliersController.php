<?php

namespace App\Http\Controllers;

use App\Supplier;
use App\Transformers\SupplierTransformer;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;

class SuppliersController extends ApiController
{
    protected $supplierTransformer;

    function __construct(SupplierTransformer $supplierTransformer)
    {
        $this->supplierTransformer = $supplierTransformer;
    }

    public function index()
    {
        $suppliers = Supplier::all();
        return Response::json([
            'data' => $this->supplierTransformer->transformCollection($suppliers->all())
        ]);
    }

    public function show($id)
    {
        $supplier = Supplier::find($id);

        if (!$supplier)
        {
            return $this->respondNotFound('Não achei esse Fornecedor :(');
        }

        return $this->respond([
            'data' => $this->supplierTransformer->transform($supplier)
        ]);
    }

}
