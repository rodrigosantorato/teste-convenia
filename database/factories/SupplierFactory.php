<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Supplier;
use App\Company;
use Faker\Generator as Faker;

$factory->define(Supplier::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'monthly_fee' => $faker->randomNumber(),
        'company_id' => factory(Company::class)->create()->id
    ];
});
