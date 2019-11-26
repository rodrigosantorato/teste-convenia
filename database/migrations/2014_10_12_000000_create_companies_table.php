<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 255);
            $table->string('email', 255)->unique();
            $table->string('password');
            $table->string('phone');
            $table->string('street_name', 70);
            $table->unsignedInteger('street_number');
            $table->string('additional_info', 255);
            $table->string('city', 70);
            $table->string('state', 70);
            $table->string('cep', 8);
            $table->string('cnpj', 14);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('companies');
    }
}
