<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('guardian_name');
            $table->string('gender');
            $table->integer('age');
            $table->string('address');
            $table->string('phone', 11);
            $table->string('cnic', 13);
            $table->string('education');
            $table->string('designation');
            $table->integer('monthly_salary');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
        });

        DB::table('employees')->insert([
            'name' => "Muneeb Akram",
            'guardian_name' => "Muhammad Akram",
            'gender' => 'male',
            'age' => 20,
            'address' => 'Sultan Town Lahore',
            'phone' => '03044429983',
            'cnic' => '3520235169171',
            'education' => 'Fsc Pre Enginnering',
            'designation' => 'IT Head',
            'monthly_salary' => 5000
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
}
