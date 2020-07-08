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
            'name' => "Mubeen ",
            'guardian_name' => "Akram",
            'gender' => 'male',
            'age' => 20,
            'address' => 'Sultan Town Lahore',
            'phone' => '03014971904',
            'cnic' => '352020510003',
            'education' => 'Medical Dispenser',
            'designation' => 'CEO',
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
