<?php

function formatCurrency($number)
{
    return 'R$ ' . number_format($number/100, 2, ',', '.');
}

function companyRules()
{
    return [
        'name' => 'required',
        'password' => 'required',
        'email' => 'required|email|unique:companies',
        'phone' => 'required|digits_between:10,11',
        'street_name' => 'required',
        'address_number' => 'required|integer',
        'additional_info' => 'nullable',
        'city' => 'required',
        'state' => 'required',
        'cep' => 'required|digits:8',
        'cnpj' => 'required|digits:14',
    ];
}

function companyMessages()
{
    return [
        'name.required' => 'Está faltando o nome.',
        'password.required' => 'Está faltando a senha.',
        'email.required' => 'Está faltando o email.',
        'email.email' => 'Por favor use um email válido.',
        'email.unique' => 'Este email já foi cadastrado no sistema.',
        'phone.required' => 'Está faltando o telefone.',
        'phone.digits_between' => 'O telefone deve conter 10 dígitos para telefones fixos ou 11 dígitos para celulares. Exemplo: 11975436571',
        'street_name.required' => 'Está faltando o nome da rua.',
        'address_number.required' => 'Está faltando o número da casa.',
        'address_number.integer' => 'Use números para o número do Lote.',
        'city.required' => 'Está faltando a cidade.',
        'state.required' => 'Está faltando o estado.',
        'cep.required' => 'Está faltando o CEP.',
        'cep.digits' => 'O CEP precisa ter 8 dígitos. Exemplo: 09060090',
        'cnpj.required' => 'Está faltando o CNPJ.',
        'cnpj.digits' => 'O CNPJ precisa ter 14 dígitos. Exemplo: 73564926574231',
    ];
}

function supplierRules()
{

}
