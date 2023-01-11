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
        Schema::create('prescriptionmedicines', function (Blueprint $table) {
            $table->id();
            $table->string('prescription_medicine_name');
            $table->string('prescription_medicine_dosage');
            $table->string('prescription_medicine_freq');
            $table->string('prescription_medicine_duration');
            $table->string('prescription_medicine_instructions');
            $table->bigInteger('prescription_id');
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
        Schema::dropIfExists('prescriptionmedicines');
    }
};
