<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest
{
    protected $validation;

    public static function getRules()
    {
        return [
            'name' => 'required|alpha_dash',
            'password' => 'required',
            'email' => 'required|email|unique:company',
            'phone' => 'required|integer|digits_between:10,11',
            'street_name' => 'required',
            'address_number' => 'required|integer',
            'additional_info' => 'nullable',
            'city' => 'required|alpha',
            'state' => 'required|alpha',
            'cep' => 'required|digits:8',
            'cnpj' => 'required|digits:14',
        ];
    }
    public function __construct()
    {
        $this->validation = [
            'name' => 'required|alpha_dash',
            'password' => 'required',
            'email' => 'required|email|unique:company',
            'phone' => 'required|integer|digits_between:10,11',
            'street_name' => 'required',
            'address_number' => 'required|integer',
            'additional_info' => 'nullable',
            'city' => 'required|alpha',
            'state' => 'required|alpha',
            'cep' => 'required|digits:8',
            'cnpj' => 'required|digits:14',
        ];
        return true;
    }

    public function authorize()
    {
        return true;
    }

    public static function validate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|alpha_dash',
            'password' => 'required',
            'email' => 'required|email|unique:company',
            'phone' => 'required|integer|digits_between:10,11',
            'street_name' => 'required',
            'address_number' => 'required|integer',
            'additional_info' => 'nullable',
            'city' => 'required|alpha',
            'state' => 'required|alpha',
            'cep' => 'required|digits:8',
            'cnpj' => 'required|digits:14',
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        }
        return $validator->validated();
    }
    public function rules()
    {
        return [
            'name' => 'required|alpha_dash',
            'password' => 'required',
            'email' => 'required|email|unique:company',
            'phone' => 'required|integer|digits_between:10,11',
            'street_name' => 'required',
            'address_number' => 'required|integer',
            'additional_info' => 'nullable',
            'city' => 'required|alpha',
            'state' => 'required|alpha',
            'cep' => 'required|digits:8',
            'cnpj' => 'required|digits:14',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'vsf'
        ];
    }
}
