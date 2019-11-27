<?php

function getRules()
{
    return [
        'name' => 'required',
        'password' => 'required',
        'email' => 'required|email|unique:companies',
        'phone' => 'required|integer|digits_between:10,11',
        'street_name' => 'required',
        'address_number' => 'required|integer',
        'additional_info' => 'nullable',
        'city' => 'required',
        'state' => 'required',
        'cep' => 'required|digits:8',
        'cnpj' => 'required|digits:14',
    ];
}

function getMessages()
{
    return [
        'name.required' => 'Está faltando o nome.',
        'password.required' => 'Está faltando a senha.',
        'email.required' => 'Está faltando o email.',
        'email.email' => 'Por favor use um email válido.',
        'phone.required' => 'Está faltando o telefone.',
        'phone.integer' => 'Use números para o telefone.',
        'phone.digits_between' => 'O telefone deve conter 10 dígitos para telefones fixos ou 11 dígitos para celulares.',
        'street_name.required' => 'Está faltando o nome da rua.',
        'address_number.required' => 'Está faltando o número da casa.',
        'address_number.integer' => 'Use números para o número do Lote.',
        'city.required' => 'Está faltando a cidade.',
        'state.required' => 'Está faltando o estado.',
        'cep.required' => 'Está faltando o CEP.',
        'cnpj.required' => 'Está faltando o CNPJ.',
        'additional_info' => 'nullable',
        'state' => 'required|alpha',
        'cep' => 'required|digits:8',
        'cnpj' => 'required|digits:14',

    ];
}
