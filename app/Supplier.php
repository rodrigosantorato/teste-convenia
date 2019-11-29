<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = [
        'name', 'email', 'monthly_fee'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function companies()
    {
        return $this->belongsTo(Company::class);
    }
}
