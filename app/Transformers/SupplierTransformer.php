<?php


namespace App\Transformers;


class SupplierTransformer extends Transformer
{
    public function transform($supplier)
    {
        return [
            'name' => $supplier['name'],
            'email' => $supplier['email'],
            'monthly_fee' => BrlTransformer::transformToBrl($supplier['monthly_fee'])
        ];
    }
}
