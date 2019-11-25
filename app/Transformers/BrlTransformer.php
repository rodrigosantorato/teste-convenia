<?php


namespace App\Transformers;


abstract class BrlTransformer
{
    static function transformToBrl($number)
    {
        return 'R$ ' . number_format($number/100, 2, ',', '.');
    }
}
