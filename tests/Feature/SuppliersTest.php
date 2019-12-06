<?php

namespace Tests\Feature;

use App\Company;
use App\Supplier;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SuppliersTest extends TestCase
{
    use RefreshDatabase;

    public function __construct()
    {
        parent::__construct();
    }

    public function test_it_deletes_a_supplier()
    {
        $supplier = factory(Supplier::class)->create();

        $this->call(
            'DELETE',
            'api/companies/'. $supplier->company_id. '/suppliers/'. $supplier->id,
                [
                    'supplier' => $supplier
                ]);

        $this->assertDatabaseMissing('suppliers', $supplier->toArray());
    }

    public function test_it_creates_a_supplier()
    {
        $company = factory(Company::class)->create();

        $supplier = factory(Supplier::class)->make(['company_id' => $company->id]);

        $this->call(
            'POST',
            'api/companies/'. $company->id. '/suppliers',
                [
                    'name' => $supplier['name'],
                    'email' => $supplier['email'],
                    'monthly_fee' => $supplier['monthly_fee'],
                    'company_id' => $supplier['id']
                ]);
        $this->assertDatabaseHas('suppliers', $supplier->toArray());
    }

    public function test_it_updates_a_supplier()
    {
        $supplier = factory(Supplier::class)->create();

        $updatedSupplier = factory(Supplier::class)->make(['company_id' => $supplier->company_id]);

        $this->call(
            'PUT',
            'api/companies/'. $supplier->company_id. '/suppliers/' .$supplier->id,
                [
                    'name' => $updatedSupplier['name'],
                    'email' => $updatedSupplier['email'],
                    'monthly_fee' => $updatedSupplier['monthly_fee']
                ]);
        $this->assertDatabaseHas('suppliers', $updatedSupplier->toArray());
    }

    public function test_it_shows_a_supplier()
    {
        $supplier = factory(Supplier::class)->create();

        $response = $this->call(
            'GET',
            'api/companies/'. $supplier->company_id. '/suppliers/' .$supplier->id);

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'Supplier' => [
                    'id',
                    'name',
                    'email',
                    'monthly_fee'
                ]
            ]);
    }
}
