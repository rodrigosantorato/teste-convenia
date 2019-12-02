<?php


namespace App\Transformers;

class SupplierTransformer extends Transformer
{
    public function transform($supplier)
    {
        return [
            'id' => $supplier['id'],
            'name' => $supplier['name'],
            'email' => $supplier['email'],
            'monthly_fee' => formatCurrency($supplier['monthly_fee']),
        ];
    }
}
