<?php


namespace App\Transformers;


class UserTransformer extends Transformer
{
    public function transform($user)
    {
        return [
            'id' => $user['id'],
            'name' => $user['name'],
            'email' => $user['email'],
            'password' => $user['password'],
            'phone' => $user['phone'],
            'street_name' => $user['street_name'],
            'address_number' =>  $user['address_number'],
            'additional_info' => $user['additional_info'],
            'city' => $user['city'],
            'state' => $user['state'],
            'cep' => $user['cep'],
            'cnpj' => $user['cnpj'],
        ];
    }
}
