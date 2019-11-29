<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\User;
use App\Supplier;

class SuppliersTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $users = User::all();
        foreach($users as $user)
        {
            Supplier::create([
                'name' => $faker->company,
                'email' => $faker->email,
                'monthly_fee' => $faker->randomNumber(7),
                'user_id' => $user->id
            ]);
            Supplier::create([
                'name' => $faker->company,
                'email' => $faker->email,
                'monthly_fee' => $faker->randomNumber(7),
                'user_id' => $user->id
            ]);
        }
    }
}
