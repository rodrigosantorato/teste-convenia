<?php


namespace App\Transformers;


class SupplierTransformer extends Transformer
{
    public function transform($supplier)
    {
        return [
            'supplier_name' => $supplier['supplier_name'],
            'email' => $supplier['email'],
            'monthly_fee' => BrlTransformer::transformToBrl($supplier['monthly_fee'])
        ];
    }
}
