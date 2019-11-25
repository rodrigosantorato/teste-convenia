<?php


namespace App\Transformers;


class CompanyTransformer extends Transformer
{
    public function transform($company)
    {
        return [
            'company_name' => $company['company_name'],
            'email' => $company['email'],
            'password' => $company['password'],
            'phone' => (int) $company['phone'],
            'street_name' => $company['street_name'],
            'street_number' => (int) $company['street_number'],
            'additional_info' => $company['additional_info'],
            'city' => $company['city'],
            'state' => $company['state'],
            'cep' => (int) $company['cep'],
            'cnpj' => (int) $company['cnpj'],
        ];
    }
}
