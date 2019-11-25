<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Company;
use App\Supplier;

class SuppliersTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $companies = Company::all();
        foreach($companies as $company)
        {
            Supplier::create([
                'supplier_name' => $faker->company,
                'email' => $faker->email,
                'monthly_fee' => $faker->randomNumber(7),
                'company_id' => $company->id
            ]);
            Supplier::create([
                'supplier_name' => $faker->company,
                'email' => $faker->email,
                'monthly_fee' => $faker->randomNumber(7),
                'company_id' => $company->id
            ]);
        }
    }
}
