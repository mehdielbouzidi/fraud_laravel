<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('customerId');
            $table->unsignedInteger('bsn');
            $table->string('firstName');
            $table->string('lastName');
            $table->date('dateOfBirth');
            $table->string('phoneNumber');
            $table->string('email');
            $table->string('tag');
            $table->string('ipAddress');
            $table->string('iban');
            $table->date('lastInvoiceDate');
            $table->dateTime('lastLoginDateTime');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('customers');
    }
};
