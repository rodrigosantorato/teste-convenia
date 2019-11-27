<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Company extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'phone', 'street_name', 'address_number', 'additional_info', 'city', 'state' , 'cep', 'cnpj'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function suppliers()
    {
        return $this->hasMany(Supplier::class);
    }
}
