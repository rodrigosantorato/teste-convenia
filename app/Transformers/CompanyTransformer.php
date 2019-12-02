<?php


namespace App\Transformers;

class CompanyTransformer extends Transformer
{
    public function transform($company)
    {
        return [
            'id' => $company['id'],
            'name' => $company['name'],
            'email' => $company['email'],
            'password' => $company['password'],
            'phone' => $company['phone'],
            'street_name' => $company['street_name'],
            'address_number' =>  $company['address_number'],
            'additional_info' => $company['additional_info'],
            'city' => $company['city'],
            'state' => $company['state'],
            'cep' => $company['cep'],
            'cnpj' => $company['cnpj'],
        ];
    }
}
