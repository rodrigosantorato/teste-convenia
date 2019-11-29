<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('phone', 11|10);
            $table->string('street_name');
            $table->unsignedInteger('address_number');
            $table->string('additional_info')->nullable(true)->default(null);
            $table->string('city');
            $table->string('state');
            $table->string('cep', 8);
            $table->string('cnpj', 14);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}
