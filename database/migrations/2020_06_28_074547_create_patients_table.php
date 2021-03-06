<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('doctor_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('name');
            $table->string("guardian_name")->nullable();
            $table->string('gender');
            $table->integer('age');
            $table->string('phone', 11)->nullable();
            $table->integer('fee')->default(50);
            $table->integer('token');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));

            // $table->foreign('user_id')->references('id')->on('users');
            // $table->foreign('doctor_id')->references('id')->on('employees');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patients');
    }
}
