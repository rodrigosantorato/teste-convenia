<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Company;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Company::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'phone' => $faker->numerify('11#########'),
        'street_name' => $faker->streetName,
        'address_number' => $faker->numberBetween(0,1400),
        'additional_info' => 'random-info',
        'city' => $faker->city,
        'state' => $faker->state,
        'cep' => $faker->numerify('########'),
        'cnpj' => $faker->numerify('##############'),
    ];
});
