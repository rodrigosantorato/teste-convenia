<?php

namespace Tests\Feature;

use App\Company;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CompaniesTest extends TestCase
{
    use RefreshDatabase;

    public function __construct()
    {
        parent::__construct();
    }

    public function test_it_creates_a_company()
    {
        $company = factory(Company::class)->make();

        $this->call(
            'POST',
            'api/companies',
            [
                'name' => $company['name'],
                'email' => $company['email'],
                'password' => $company['password'],
                'phone' => $company['phone'],
                'street_name' => $company['street_name'],
                'address_number' => $company['address_number'],
                'additional_info' => $company['additional_info'],
                'city' => $company['city'],
                'state' => $company['state'],
                'cep' => $company['cep'],
                'cnpj' => $company['cnpj']
            ]);
        $this->assertDatabaseHas('companies', $company->toArray());
    }
}
