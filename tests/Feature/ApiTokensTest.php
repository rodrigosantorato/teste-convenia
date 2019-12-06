<?php

namespace Tests\Feature;

use App\Company;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ApiTokensTest extends TestCase
{
    use RefreshDatabase;

    public function __construct()
    {
        parent::__construct();
    }

    public function test_it_creates_a_token()
    {
        $company = factory(Company::class)->create();

        $this->call(
            'POST',
            'api/companies/'. $company->id. '/token',
            [
                'email' => $company['email'],
                'password' => $company['password'],
            ]);

        $company = Company::first();

        $this->assertNotNull($company->api_token);
    }
}
