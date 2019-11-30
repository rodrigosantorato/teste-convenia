<?php

function formatCurrency($number)
{
    return 'R$ ' . number_format($number/100, 2, ',', '.');
}

function companyRules()
{
    return [
        'name' => 'required|max:255',
        'password' => 'required|max:255',
        'email' => 'required|email|unique:companies|max:255',
        'phone' => 'required|digits_between:10,11',
        'street_name' => 'required|max:255',
        'address_number' => 'required|integer|digits_between:1,10',
        'additional_info' => 'nullable|max:255',
        'city' => 'required|max:255',
        'state' => 'required|max:255',
        'cep' => 'required|digits:8',
        'cnpj' => 'required|digits:14',
    ];
}

function companyMessages()
{
    return [
        'name.required' => 'Está faltando o nome.',
        'name.max' => 'Opa! Esse nome é um pouco grande demais, não é?.',
        'password.required' => 'Está faltando a senha.',
        'password.max' => 'Opa! Essa senha é um pouco grande demais, não é?.',
        'email.required' => 'Está faltando o email.',
        'email.email' => 'Por favor use um email válido.',
        'email.unique' => 'Este email já foi cadastrado no sistema.',
        'email.max' => 'Opa! Esse email é um pouco grande demais, não é?.',
        'phone.required' => 'Está faltando o telefone.',
        'phone.digits_between' => 'O telefone deve conter 10 dígitos para telefones fixos ou 11 dígitos para celulares. Exemplo: 11975436571',
        'street_name.required' => 'Está faltando o nome da rua.',
        'street_name.max' => 'Opa! Esse endereço é um pouco grande demais, não é?.',
        'address_number.required' => 'Está faltando o número da casa.',
        'address_number.integer' => 'Use números para o número do Lote.',
        'address_number.digits_between' => 'Opa! Esse número de lote é um pouco grande demais, não é?.',
        'additional_info.max' => 'Opa! Tem informação demais aí, não é mesmo?.',
        'city.required' => 'Está faltando a cidade.',
        'city.max' => 'Opa! Esse nome de cidade é um pouco grande demais, não é?.',
        'state.required' => 'Está faltando o estado.',
        'state.max' => 'Opa! Esse nome de estado é um pouco grande demais, não é?.',
        'cep.required' => 'Está faltando o CEP.',
        'cep.digits' => 'O CEP precisa ter 8 dígitos. Exemplo: 09060090',
        'cnpj.required' => 'Está faltando o CNPJ.',
        'cnpj.digits' => 'O CNPJ precisa ter 14 dígitos. Exemplo: 73564926574231',
    ];
}

function supplierRules()
{
    return [
        'name' => 'required|max:255',
        'email' => 'required|email|max:255',
        'monthly_fee' => 'required|integer|digits_between:1,254'
        ];
}

function supplierMessages()
{
    return [
        'name.required' => 'Acho que você esqueceu o nome do fornecedor.',
        'name.max' => 'Opa! Esse nome é um pouco grande demais, não é?.',
        'email.required' => 'Acho que você esqueceu o email.',
        'email.email' => 'Por favor use um email válido.',
        'email.max' => 'Opa! Esse email é um pouco grande demais, não é?.',
        'monthly_fee.required' => 'Acho que você esqueceu a mensalidade.',
        'monthly_fee.integer' => 'A mensalidade é informada em centavos e sem vírgulas ou pontos. Exemplo: R$ 2.500,00 deve ser informado como 250000',
        'monthly_fee.digits_between' => 'Essa mensalidade é grande demais.'
    ];
}

function getTokenRules()
{

}

function getTokenMessages()
{

}
