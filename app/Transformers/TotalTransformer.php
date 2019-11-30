<?php


namespace App\Transformers;


class TotalTransformer extends Transformer
{
    public function transform($total)
    {
        return formatCurrency($total);
    }
}
