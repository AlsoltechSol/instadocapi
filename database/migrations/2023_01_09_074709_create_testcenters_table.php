<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('testcenters', function (Blueprint $table) {
            $table->id();
            $table->string('lab_name');
            $table->string('lab_address');
            $table->string('contactno');
            $table->string('emailaddress');
            $table->string('contactperson');
            $table->string('registrationno')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('testcenters');
    }
};
