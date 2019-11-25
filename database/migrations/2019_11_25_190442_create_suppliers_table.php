<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuppliersTable extends Migration
{

    public function up()
    {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('supplier_name', 255);
            $table->string('email', 255);
            $table->string('monthly_fee');
            $table->unsignedBigInteger('company_id');
            $table->foreign('company_id')->references('id')->on('companies');
            $table->timestamps();
        });
    }

    public function company()
    {
        return $this->belongsTo('App\Company');
    }

    public function down()
    {
        Schema::dropIfExists('suppliers');
    }
}
