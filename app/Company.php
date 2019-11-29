<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Company extends Authenticatable
{
    use Notifiable, HasApiTokens;

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
