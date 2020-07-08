<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateMedicinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicines', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->float('unit_price');
            $table->integer('quantity');
            $table->timestamps();
        });

        DB::table('medicines')->insert([
            'name' => 'Panadol 400mg',
            'quantity' => 40,
            'unit_price' => 1.5
        ]);
        DB::table('medicines')->insert([
            'name' => 'Amoxil 500mg',
            'quantity' => 400,
            'unit_price' => 12
        ]);
        DB::table('medicines')->insert([
            'name' => 'Septran 400mg',
            'quantity' => 60,
            'unit_price' => 4.8
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medicines');
    }
}
