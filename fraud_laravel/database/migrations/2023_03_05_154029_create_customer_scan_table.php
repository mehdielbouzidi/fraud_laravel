<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('customer_scan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customerId');
            $table->unsignedBigInteger('scanId');
            $table->enum('fraudReason', ['SAME_IP', 'SAME_IBAN', 'NON_NL_PHONE', 'UNDERAGE'])->nullable();
            $table->foreign('customerId')->references('id')->on('customers')->onDelete('cascade');
            $table->foreign('scanId')->references('id')->on('scans')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('customer_scan');
    }
};
