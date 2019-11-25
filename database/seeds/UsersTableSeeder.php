<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\User;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        foreach(range(1, 30) as $index)
        {
            User::create([
                'name' => $faker->name,
                'email' => $faker->email,
                'password' => $faker->password,
                'street_name' => $faker->streetName,
                'street_number' => $faker->numberBetween(14, 1298),
                'additional_info' => $faker->sentence,
                'city' => $faker->city,
                'state' => $faker->state,
                'cep' => $faker->numerify('########'),
                'cnpj' => $faker->numerify('##############'),
                'phone' => $faker->phoneNumber
            ]);
        }
    }
}
