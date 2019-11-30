<?php


namespace App\Services;


use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class SupplierValidator
{
    protected $errors;
    protected $validated;

    public function validate(Request $request)
    {
        $validator = Validator::make($request->all(), supplierRules(), supplierMessages());
        if ($validator->fails()) {
            $this->errors = $validator->errors();
            return false;
        }
        $this->validated = $validator->validated();
        return true;
    }

    public function errors()
    {
        return $this->errors;
    }

    public function validated()
    {
        return $this->validated;
    }
}
